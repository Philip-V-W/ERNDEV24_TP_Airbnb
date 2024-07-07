<?php

namespace App\Controller;

use App\AppRepoManager;
use Core\Controller\Controller;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\View\View;
use Exception;
use Laminas\Diactoros\ServerRequest;

class ResidenceController extends Controller
{
    // Display the homepage
//    public function viewHomepage(): void
//    {
//        $view = new View('home/index');
//        $view->render();
//    }

    // Show search results
    public function viewResults(): void
    {
        $view = new View('home/results');
        $view->render();
    }





    public function viewRooms(ServerRequest $request, int $id): void
    {
        // Fetch the specific listing by ID
        $listingRepository = AppRepoManager::getRm()->getResidenceRepository();
        $mediaRepository = AppRepoManager::getRm()->getMediaRepository();
        $equipmentRepository = AppRepoManager::getRm()->getEquipmentRepository();
        $residenceEquipmentRepository = AppRepoManager::getRm()->getResidenceEquipmentRepository();
        $addressRepository = AppRepoManager::getRm()->getAddressRepository();
        $userRepository = AppRepoManager::getRm()->getUserRepository(); // Add user repository to fetch host info

        $listing = $listingRepository->findResidenceById($id);
        if (!$listing) {
            throw new Exception("Listing not found");
        }

        // Fetch media for the listing (limit to 5)
        $photos = array_slice($mediaRepository->findByResidenceId($listing->id), 0, 5);

        // Fetch the address for the listing
        $address = $addressRepository->findAddressById($listing->address_id);

        // Fetch the equipment IDs associated with the listing
        $equipmentIds = $residenceEquipmentRepository->findEquipmentIdsByResidenceId($listing->id);

        // Fetch the equipment details for the IDs
        $equipments = $equipmentRepository->findEquipmentsByIds($equipmentIds);

        // Fetch the host's information
        $host = $userRepository->fetchUserById($listing->user_id);


        // Pass the listing, photos, address, equipment, and host to the view
        $view = new View('home/rooms');
        $view_data = [
            'listing' => $listing,
            'photos' => $photos,
            'address' => $address,
            'equipments' => $equipments,
            'host' => $host, // Pass host information
            'user' => Session::get(Session::USER) // Pass logged-in user session if available
        ];
        $view->render($view_data);
    }










    // Display the residence form
    public function viewResidenceForm(): void
    {
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT),
            'form_success' => Session::get(Session::FORM_SUCCESS)
        ];
        $view = new View('home/residence');
        $view->render($view_data);
    }

    // Add a new residence to the database
    public function addResidenceForm(ServerRequest $request): void
    {
        $data_form = $request->getParsedBody();
        $form_result = new FormResult();

        // Validate and extract form data
        $title = $data_form['title'] ?? '';
        $description = $data_form['description'] ?? '';
        $price_per_night = $data_form['price'] ?? '';
        $size = $data_form['size'] ?? '';
        $nb_rooms = $data_form['rooms'] ?? '';
        $nb_beds = $data_form['bedrooms'] ?? '';
        $nb_baths = $data_form['bathrooms'] ?? '';
        $nb_guests = $data_form['guests'] ?? '';
        $user_id = $data_form['user_id'] ?? '';
        $type_id = $data_form['type_id'] ?? '';
        $address = $data_form['address'] ?? '';
        $city = $data_form['city'] ?? '';
        $zip_code = $data_form['zip'] ?? '';
        $country = $data_form['country'] ?? '';
        $equipment_ids = $data_form['equipment'] ?? [];

        if (empty($title) || empty($description) || empty($price_per_night) || empty($size) || empty($nb_rooms) || empty($nb_beds) || empty($nb_baths) || empty($nb_guests) || empty($user_id) || empty($type_id) || empty($address) || empty($city) || empty($zip_code) || empty($country)) {
            $form_result->addError(new FormError('Please fill in all the fields'));
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
            return;
        }

        if (!is_numeric($type_id) || !$type = AppRepoManager::getRm()->getTypeRepository()->findTypeById($type_id)) {
            $form_result->addError(new FormError('Invalid type selected'));
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
            return;
        }

        $valid_equipment_ids = AppRepoManager::getRm()->getEquipmentRepository()->getAllEquipmentIds();
        foreach ($equipment_ids as $equipment_id) {
            if (!in_array($equipment_id, $valid_equipment_ids)) {
                $form_result->addError(new FormError('Invalid equipment selected'));
                Session::set(Session::FORM_RESULT, $form_result);
                self::redirect('/residence');
                return;
            }
        }

        $address_data = [
            'address' => $address,
            'city' => $city,
            'zip_code' => $zip_code,
            'country' => $country
        ];

        $address_id = AppRepoManager::getRm()->getAddressRepository()->insertAddress($address_data);

        if (is_null($address_id)) {
            $form_result->addError(new FormError('An error occurred while adding the address'));
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
            return;
        }

        $residence_data = [
            'title' => $title,
            'description' => $description,
            'price_per_night' => $price_per_night,
            'size' => $size,
            'nb_rooms' => $nb_rooms,
            'nb_beds' => $nb_beds,
            'nb_baths' => $nb_baths,
            'nb_guests' => $nb_guests,
            'user_id' => $user_id,
            'address_id' => $address_id,
            'type_id' => $type_id,
            'is_active' => 1
        ];

        $residence_id = AppRepoManager::getRm()->getResidenceRepository()->insertResidence($residence_data);
        if (is_null($residence_id)) {
            $form_result->addError(new FormError('An error occurred while adding the residence'));
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
            return;
        }

        foreach ($equipment_ids as $equipment_id) {
            $equipment_data = [
                'residence_id' => $residence_id,
                'equipment_id' => $equipment_id
            ];
            AppRepoManager::getRm()->getEquipmentRepository()->insertResidenceEquipment($equipment_data);
        }

        // Handle multiple file uploads including cover image and additional images
        $uploadDir = 'uploads/';
        $all_files = [];
        if (isset($_FILES['photo_url']) && $_FILES['photo_url']['error'] !== UPLOAD_ERR_NO_FILE) {
            $all_files[] = $_FILES['photo_url'];
        }
        if (isset($_FILES['photo_url_additional']) && !empty($_FILES['photo_url_additional']['name'][0])) {
            foreach ($_FILES['photo_url_additional']['name'] as $key => $value) {
                $all_files[] = [
                    'name' => $_FILES['photo_url_additional']['name'][$key],
                    'type' => $_FILES['photo_url_additional']['type'][$key],
                    'tmp_name' => $_FILES['photo_url_additional']['tmp_name'][$key],
                    'error' => $_FILES['photo_url_additional']['error'][$key],
                    'size' => $_FILES['photo_url_additional']['size'][$key],
                ];
            }
        }

        foreach ($all_files as $file) {
            if ($file['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $file['tmp_name'];
                $fileName = $file['name'];
                $fileNameComps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameComps));

                // Sanitize file name
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                // Check if file is a valid image type
                $allowedFileExtensions = ['jpg', 'gif', 'png', 'jpeg', 'webp'];
                if (in_array($fileExtension, $allowedFileExtensions)) {
                    // Ensure the upload directory exists
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    // Directory where the file will be moved
                    $dest_path = $uploadDir . $newFileName;

                    // Move the file to the upload directory
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        // Insert file path into media table
                        $media_data = [
                            'image_path' => $dest_path,
                            'residence_id' => $residence_id
                        ];
                        AppRepoManager::getRm()->getMediaRepository()->addMedia($media_data);
                    } else {
                        $form_result->addError(new FormError('There was an error moving the uploaded file.'));
                        Session::set(Session::FORM_RESULT, $form_result);
                        self::redirect('/residence');
                        return;
                    }
                } else {
                    $form_result->addError(new FormError('Upload failed. Allowed file types: ' . implode(',', $allowedFileExtensions)));
                    Session::set(Session::FORM_RESULT, $form_result);
                    self::redirect('/residence');
                    return;
                }
            } elseif ($file['error'] !== UPLOAD_ERR_NO_FILE) {
                $form_result->addError(new FormError('Error uploading file: ' . $file['name']));
            }
        }

        if ($form_result->hasErrors()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
        } else {
            Session::remove(Session::FORM_RESULT);
            Session::set(Session::FORM_SUCCESS, $form_result);
            self::redirect('/manage-listings');
        }
    }











    // Edit an existing residence
    public function editResidence(int $residenceId, ServerRequest $request): void
    {
        // Logic to edit a residence
        $residence = AppRepoManager::getRm()->getResidenceRepository()->findResidenceById($residenceId);
        if (!$residence) {
            self::redirect('/not-found');
            return;
        }

        $data_form = $request->getParsedBody();
        $residence->title = $data_form['title'] ?? $residence->title;
        $residence->description = $data_form['description'] ?? $residence->description;
        $residence->price_per_night = $data_form['price'] ?? $residence->price_per_night;
        // Update other fields similarly...

        AppRepoManager::getRm()->getResidenceRepository()->updateResidenceById($residence);

        self::redirect('/residence/view/' . $residenceId);
    } // TODO: fix

    // Delete a residence
    public function deleteResidence(ServerRequest $request, int $id): void
    {
        if (!AuthController::isAuth()) {
            self::redirect('/login-form');
            return;
        }

        try {
            // Fetch the residence to get its associated images
            $residenceRepository = AppRepoManager::getRm()->getResidenceRepository();
            $mediaRepository = AppRepoManager::getRm()->getMediaRepository();

            // Fetch associated media
            $mediaList = $mediaRepository->findByResidenceId($id);

            // Delete associated images from the filesystem
            foreach ($mediaList as $media) {
                $imagePath = $media->getImagePath();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Delete the residence and associated records
            $residenceRepository->deleteResidenceById($id);

            // Redirect to the manage listings page
            self::redirect('/manage-listings'); // Ensure this redirect path is correct
        } catch (Exception $e) {
            error_log("Error deleting residence: " . $e->getMessage());
            echo "Error deleting residence: " . $e->getMessage(); // For debugging purposes
        }
    }







    public function viewHomepage(): void
    {
        // Fetch simplified listings from the repository
        $listings = AppRepoManager::getRm()->getResidenceRepository()->getAllListings();

        error_log("Listings passed to view: " . print_r($listings, true)); // Log the data passed to the view

        // Render the view with the listings
        $view = new View('home/index');
        $view->render([
            'listings' => $listings,
        ]);
    }















}
