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
    /**
     * Show search results.
     */
    public function viewResults(): void
    {
        // Render the search results view
        $view = new View('home/results');
        $view->render();
    }

    /**
     * View details of a specific residence.
     *
     * @param ServerRequest $request The server request object.
     * @param int $id The residence ID.
     * @throws Exception
     */
    public function viewRooms(ServerRequest $request, int $id): void
    {
        // Fetch the specific listing by ID
        $listingRepository = AppRepoManager::getRm()->getResidenceRepository();
        $mediaRepository = AppRepoManager::getRm()->getMediaRepository();
        $equipmentRepository = AppRepoManager::getRm()->getEquipmentRepository();
        $residenceEquipmentRepository = AppRepoManager::getRm()->getResidenceEquipmentRepository();
        $addressRepository = AppRepoManager::getRm()->getAddressRepository();
        $userRepository = AppRepoManager::getRm()->getUserRepository();

        // Find the listing by ID
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
        $view->render([
            'listing' => $listing,
            'photos' => $photos,
            'address' => $address,
            'equipments' => $equipments,
            'host' => $host,
            'user' => Session::get(Session::USER)
        ]);
    }

    /**
     * Display the residence form.
     */
    public function viewResidenceForm(): void
    {
        // Render the residence form view with form result and success messages
        $view = new View('home/residence');
        $view->render([
            'form_result' => Session::get(Session::FORM_RESULT),
            'form_success' => Session::get(Session::FORM_SUCCESS)
        ]);
    }

    /**
     * Add a new residence to the database.
     *
     * @param ServerRequest $request The server request object.
     */
    public function addResidenceForm(ServerRequest $request): void
    {
        $data_form = $request->getParsedBody();
        $form_result = new FormResult();

        // Validate and extract form data
        $required_fields = ['title', 'description', 'price', 'size', 'rooms', 'bedrooms', 'bathrooms', 'guests', 'user_id', 'type_id', 'address', 'city', 'zip', 'country'];
        foreach ($required_fields as $field) {
            if (empty($data_form[$field])) {
                $form_result->addError(new FormError('Please fill in all the fields'));
                Session::set(Session::FORM_RESULT, $form_result);
                self::redirect('/residence');
                return;
            }
        }

        // Validate type ID
        $type_id = $data_form['type_id'];
        if (!is_numeric($type_id) || !$type = AppRepoManager::getRm()->getTypeRepository()->findTypeById($type_id)) {
            $form_result->addError(new FormError('Invalid type selected'));
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
            return;
        }

        // Validate equipment IDs
        $equipment_ids = $data_form['equipment'] ?? [];
        $valid_equipment_ids = AppRepoManager::getRm()->getEquipmentRepository()->getAllEquipmentIds();
        foreach ($equipment_ids as $equipment_id) {
            if (!in_array($equipment_id, $valid_equipment_ids)) {
                $form_result->addError(new FormError('Invalid equipment selected'));
                Session::set(Session::FORM_RESULT, $form_result);
                self::redirect('/residence');
                return;
            }
        }

        // Insert address data
        $address_data = [
            'address' => $data_form['address'],
            'city' => $data_form['city'],
            'zip_code' => $data_form['zip'],
            'country' => $data_form['country']
        ];

        //
        $address_id = AppRepoManager::getRm()->getAddressRepository()->insertAddress($address_data);
        if (is_null($address_id)) {
            $form_result->addError(new FormError('An error occurred while adding the address'));
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
            return;
        }

        // Insert residence data
        $residence_data = [
            'title' => $data_form['title'],
            'description' => $data_form['description'],
            'price_per_night' => $data_form['price'],
            'size' => $data_form['size'],
            'nb_rooms' => $data_form['rooms'],
            'nb_beds' => $data_form['bedrooms'],
            'nb_baths' => $data_form['bathrooms'],
            'nb_guests' => $data_form['guests'],
            'user_id' => $data_form['user_id'],
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

        // Insert equipment data for the residence
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

        // Process file uploads
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

        // Check if there are any form errors
        if ($form_result->hasErrors()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
        } else {
            Session::remove(Session::FORM_RESULT);
            Session::set(Session::FORM_SUCCESS, $form_result);
            self::redirect('/manage-listings');
        }
    }

    /**
     * Edit an existing residence.
     *
     * @param ServerRequest $request The server request object.
     * @param int $id The residence ID.
     */
    public function editResidence(ServerRequest $request, int $id): void
    {
        // Find the residence by ID
        $residence = AppRepoManager::getRm()->getResidenceRepository()->findResidenceById($id);
        if (!$residence) {
            self::redirect('/not-found');
            return;
        }

        // Fetch the address data
        $address = AppRepoManager::getRm()->getAddressRepository()->findAddressById($residence->address_id);

        // Fetch the equipment data associated with the residence
        $residenceEquipmentIds = AppRepoManager::getRm()->getEquipmentRepository()->getEquipmentsByResidenceId($id);
        $residenceEquipments = AppRepoManager::getRm()->getEquipmentRepository()->findEquipmentsByIds($residenceEquipmentIds);

        // Fetch images
        $images = AppRepoManager::getRm()->getMediaRepository()->getImagesByResidenceId($id);

        // If the form is submitted
        if ($request->getMethod() == 'POST') {
            $data_form = $request->getParsedBody();

            // Update residence fields
            $residence->title = $data_form['title'] ?? $residence->title;
            $residence->description = $data_form['description'] ?? $residence->description;
            $residence->price_per_night = $data_form['price'] ?? $residence->price_per_night;
            $residence->size = $data_form['size'] ?? $residence->size;
            $residence->nb_rooms = $data_form['rooms'] ?? $residence->nb_rooms;
            $residence->nb_beds = $data_form['bedrooms'] ?? $residence->nb_beds;
            $residence->nb_baths = $data_form['bathrooms'] ?? $residence->nb_baths;
            $residence->nb_guests = $data_form['guests'] ?? $residence->nb_guests;
            $residence->type_id = $data_form['type_id'] ?? $residence->type_id;

            // Update address data
            $address_data = [
                'address' => $data_form['address'],
                'city' => $data_form['city'],
                'zip_code' => $data_form['zip'],
                'country' => $data_form['country']
            ];

            // Handle image upload
            $uploadedFiles = $request->getUploadedFiles();
            $imagePaths = [];

            if (isset($uploadedFiles['photo_url']) && $uploadedFiles['photo_url']->getError() === UPLOAD_ERR_OK) {
                $photo_url = $uploadedFiles['photo_url'];
                $imagePaths[] = $this->handleImageUpload($photo_url);
            }

            if (isset($uploadedFiles['photo_url_additional'])) {
                foreach ($uploadedFiles['photo_url_additional'] as $file) {
                    if ($file->getError() === UPLOAD_ERR_OK) {
                        $imagePaths[] = $this->handleImageUpload($file);
                    }
                }
            }

            // Update the residence and address in the database
            $updated = AppRepoManager::getRm()->getResidenceRepository()->updateResidenceById($id, (array)$residence);
            $updatedAddress = AppRepoManager::getRm()->getAddressRepository()->updateAddressById($address->id, $address_data);

            // Save the uploaded images
            if (!empty($imagePaths)) {
                AppRepoManager::getRm()->getMediaRepository()->updateResidenceImages($id, $imagePaths);
            }

            // Update equipment data
            $selectedEquipments = $data_form['equipment'] ?? [];
            AppRepoManager::getRm()->getEquipmentRepository()->updateResidenceEquipments($id, $selectedEquipments);

            // Redirect to manage listings if update is successful
            if ($updated && $updatedAddress) {
                self::redirect('/manage-listings');
            }
        }

        // Fetch necessary data for the form
        $equipments = AppRepoManager::getRm()->getEquipmentRepository()->getAllEquipment();
        $types = AppRepoManager::getRm()->getTypeRepository()->getAllTypes();

        // Render the edit residence view
        $view = new View('home/edit-residence');
        $view->render([
            'residence' => $residence,
            'equipments' => $equipments,
            'types' => $types,
            'address' => $address,
            'residence_equipments' => $residenceEquipments,
            'residence_id' => $id,
            'images' => $images
        ]);
    }

    /**
     * Handle image upload.
     *
     * @param object $file The uploaded file object.
     * @return string|null The path to the uploaded file or null if the upload fails.
     */
    public function handleImageUpload($file): ?string
    {
        $uploadDir = 'uploads/';
        $fileName = $file->getClientFilename();
        $fileTmpPath = $file->getStream()->getMetadata('uri');
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
                return $dest_path;
            }
        }
        return null;
    }

    /**
     * Delete a residence.
     *
     * @param ServerRequest $request The server request object.
     * @param int $id The residence ID.
     */
    public function deleteResidence(ServerRequest $request, int $id): void
    {
        // Ensure the user is authenticated
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
            self::redirect('/manage-listings');
        } catch (Exception $e) {
            error_log("Error deleting residence: " . $e->getMessage());
            echo "Error deleting residence: " . $e->getMessage(); // For debugging purposes
        }
    }

    /**
     * View homepage.
     */
    public function viewHomepage(): void
    {
        // Fetch simplified listings from the repository
        $listings = AppRepoManager::getRm()->getResidenceRepository()->getAllListings();

        // Render the view with the listings
        $view = new View('home/index');
        $view->render([
            'listings' => $listings,
        ]);
    }
}
