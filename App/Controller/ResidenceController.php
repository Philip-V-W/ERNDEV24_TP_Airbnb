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
        // Create a new view for the home page
        $view = new View('home/residence');
        // Render the view
        $view->render();
    }

    /**
     * Function that receives the form data and adds a residence
     * @param ServerRequest $request
     * @return void
     */
    public function addResidenceForm(ServerRequest $request): void
    {
        $data_form = $request->getParsedBody();
        $form_result = new FormResult();

        // We retrieve the data from the form
        // Residence data
        $title = $data_form['title'] ?? '';
        $description = $data_form['description'] ?? '';
        $price_per_night = $data_form['price'] ?? '';
        $nb_rooms = $data_form['rooms'] ?? '';
        $nb_beds = $data_form['bedrooms'] ?? '';
        $nb_baths = $data_form['bathrooms'] ?? '';
        $nb_guests = $data_form['guests'] ?? '';
        $user_id = $data_form['user_id'] ?? '';
        $type_id = $data_form['type_id'] ?? '';
        $address_id = $data_form['address_id'] ?? '';
        // Type data
        $label = $data_form['type'] ?? '';
        // Address data
        $address = $data_form['address'] ?? '';
        $city = $data_form['city'] ?? '';
        $zip_code = $data_form['zip'] ?? '';
        $country = $data_form['country'] ?? '';

        // We check if the fields are empty
        if (empty($title)
            || empty($description)
            || empty($price_per_night)
            || empty($nb_rooms)
            || empty($nb_beds)
            || empty($nb_baths)
            || empty($nb_guests)
            || empty($user_id)
            || empty($type_id)
            || empty($address_id)
            || empty($label)
            || empty($address)
            || empty($city)
            || empty($zip_code)
            || empty($country)) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
        } else {
            // We check if the residence already exists
            $residence_data = [
                'title' => $title,
                'description' => $description,
                'price_per_night' => $price_per_night,
                'nb_rooms' => $nb_rooms,
                'nb_beds' => $nb_beds,
                'nb_baths' => $nb_baths,
                'nb_guests' => $nb_guests,
                'user_id' => $user_id,
                'type_id' => $type_id,
                'address_id' => $address_id,
                'is_active' => 1
            ];

            $residence_id = AppRepoManager::getRm()->getResidenceRepository()->insertResidence($residence_data);
            if (is_null($residence_id)) {
                $form_result->addError(new FormError('Une erreur est survenue lors de l\'ajout de la résidence'));
            } else {
                // We build a data array to insert the type
                $type_data = [
                    'label' => $label
                ];

                $residence_type = AppRepoManager::getRm()->getTypeRepository()->insertType($type_data);
                if (!$residence_type) {
                    $form_result->addError(new FormError('Une erreur est survenue lors de l\'ajout du type'));
                } else {
                    // We build a data array to insert the address
                    $address_data = [
                        'address' => $address,
                        'city' => $city,
                        'zip_code' => $zip_code,
                        'country' => $country
                    ];

                    $residence_address = AppRepoManager::getRm()->getUserRepository()->insertAddress($address_data);
                    if (!$residence_address) {
                        $form_result->addError(new FormError('Une erreur est survenue lors de l\'ajout de l\'adresse'));
                    } else {
                        $form_result->addSuccess(new FormSuccess('The residence has been successfully added'));
                    }
                }
            }
        }

        // We check if the form has errors
        if ($form_result->hasErrors()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/user/insert-residence/' . $user_id);
        } elseif ($form_result->getSuccessMessage()) {
            // If we have success messages, we put them in sessions
            Session::remove(Session::FORM_RESULT);
            Session::set(Session::FORM_SUCCESS, $form_result);
            // self::redirect('/user/list-custom-pizza/' . $user_id); // TODO: Change the redirection to the residence list
        }
    }


}