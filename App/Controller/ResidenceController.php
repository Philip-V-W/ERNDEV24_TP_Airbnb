<?php

namespace App\Controller;

use App\AppRepoManager;
use Core\Controller\Controller;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Form\FormSuccess;
use Core\Session\Session;
use Core\View\View;
use Laminas\Diactoros\ServerRequest;

class ResidenceController extends Controller
{
    /**
     * Displays the home page.
     * @return void
     */
    public function home(): void
    {
        // Create a new view for the home page
        $view = new View('home/index');
        // Render the view
        $view->render();
    }

    /**
     * Displays the results page.
     * @return void
     */
    public function results(): void
    {
        // Create a new view for the home page
        $view = new View('home/results');
        // Render the view
        $view->render();
    }

    /**
     * Displays the rooms page.
     * @return void
     */
    public function rooms(): void
    {
        // Create a new view for the home page
        $view = new View('home/rooms');
        // Render the view
        $view->render();
    }

    /**
     * Displays the residence page.
     * @return void
     */
    public function residence(): void
    {
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT),
            'form_success' => Session::get(Session::FORM_SUCCESS)
        ];
        // Create a new view for the home page
        $view = new View('home/residence');
        // Render the view
        $view->render($view_data);
    }

    /**
     * Function that receives the form data and adds a residence
     * @param ServerRequest $request
     * @return void
     */
    public function addResidenceForm(ServerRequest $request): void
    {
        $data_form = $request->getParsedBody();
//        var_dump($data_form);die;
        $form_result = new FormResult();

        // Retrieve the data from the form
        $title = $data_form['title'] ?? '';
        $description = $data_form['description'] ?? '';
        $price_per_night = $data_form['price'] ?? '';
        $size = $data_form['size'] ?? '';
        $nb_rooms = $data_form['rooms'] ?? '';
        $nb_beds = $data_form['bedrooms'] ?? '';
        $nb_baths = $data_form['bathrooms'] ?? '';
        $nb_guests = $data_form['guests'] ?? '';
        $user_id = $data_form['user_id'] ?? '';
        $label = $data_form['type'] ?? '';
        $address = $data_form['address'] ?? '';
        $city = $data_form['city'] ?? '';
        $zip_code = $data_form['zip'] ?? '';
        $country = $data_form['country'] ?? '';
        $equipment_ids = $data_form['equipment'] ?? [];

        // Check if the fields are empty
        if (empty($title)
            || empty($description)
            || empty($price_per_night)
            || empty($size)
            || empty($nb_rooms)
            || empty($nb_beds)
            || empty($nb_baths)
            || empty($nb_guests)
            || empty($user_id)
            || empty($label)
            || empty($address)
            || empty($city)
            || empty($zip_code)
            || empty($country)
            || empty($equipment_ids)) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
        } else {
            // Fetch the existing type ID from the database
            $type_id = AppRepoManager::getRm()->getTypeRepository()->getTypeIdByLabel($label);

            if (is_null($type_id)) {
                $form_result->addError(new FormError('Type invalide sélectionné'));
            } else {
                // Validate the equipment
                $valid_equipment_ids = AppRepoManager::getRm()->getEquipmentRepository()->getAllEquipmentIds();
                foreach ($equipment_ids as $equipment_id) {
                    if (!in_array($equipment_id, $valid_equipment_ids)) {
                        $form_result->addError(new FormError('Équipement invalide sélectionné'));
                        return;
                    }
                }

                // Build a data array to insert the address
                $address_data = [
                    'address' => $address,
                    'city' => $city,
                    'zip_code' => $zip_code,
                    'country' => $country
                ];

                // Insert the address and get the address ID
                $address_id = AppRepoManager::getRm()->getAddressRepository()->insertAddress($address_data);

                if (is_null($address_id)) {
                    $form_result->addError(new FormError('Une erreur est survenue lors de l\'ajout de l\'adresse'));
                } else {
                    // Build a data array to insert the residence
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

                    // Insert the residence and get the residence ID
                    $residence_id = AppRepoManager::getRm()->getResidenceRepository()->insertResidence($residence_data);
                    if (is_null($residence_id)) {
                        $form_result->addError(new FormError('Une erreur est survenue lors de l\'ajout de la résidence'));
                    } else {
                        // Insert selected equipment for the residence
                        foreach ($equipment_ids as $equipment_id) {
                            $equipment_data = [
                                'residence_id' => $residence_id,
                                'equipment_id' => $equipment_id
                            ];
                            AppRepoManager::getRm()->getEquipmentRepository()->insertResidenceEquipment($equipment_data);
                        }
                    }
                }
            }
        }








    // We check if the form has errors
        if ($form_result->hasErrors()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
        } else{
            // If we have success messages, we put them in sessions
//            Session::remove(Session::FORM_RESULT);
//            Session::set(Session::FORM_SUCCESS, $form_result);
            self::redirect('/'); // TODO: Change the redirection to the residence list
        }
    }


}