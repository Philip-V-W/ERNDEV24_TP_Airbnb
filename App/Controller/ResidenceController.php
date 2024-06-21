<?php

namespace App\Controller;

use App\AppRepoManager;
use Core\Controller\Controller;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\View\View;
use Laminas\Diactoros\ServerRequest;

class ResidenceController extends Controller
{
    public function home(): void
    {
        $view = new View('home/index');
        $view->render();
    }

    public function results(): void
    {
        $view = new View('home/results');
        $view->render();
    }

    public function rooms(): void
    {
        $view = new View('home/rooms');
        $view->render();
    }

    public function residence(): void
    {
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT),
            'form_success' => Session::get(Session::FORM_SUCCESS)
        ];
        $view = new View('home/residence');
        $view->render($view_data);
    }

    public function addResidenceForm(ServerRequest $request): void
    {
        $data_form = $request->getParsedBody();
        $form_result = new FormResult();

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

        if (empty($title) || empty($description) || empty($price_per_night) || empty($size) || empty($nb_rooms) || empty($nb_beds) || empty($nb_baths) || empty($nb_guests) || empty($user_id) || empty($type_id) || empty($address) || empty($city) || empty($zip_code) || empty($country) || empty($equipment_ids)) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
            return;
        }

        if (!is_numeric($type_id) || !$type = AppRepoManager::getRm()->getTypeRepository()->findTypeById($type_id)) {
            $form_result->addError(new FormError('Type invalide sélectionné'));
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
            return;
        }

        $valid_equipment_ids = AppRepoManager::getRm()->getEquipmentRepository()->getAllEquipmentIds();
        foreach ($equipment_ids as $equipment_id) {
            if (!in_array($equipment_id, $valid_equipment_ids)) {
                $form_result->addError(new FormError('Équipement invalide sélectionné'));
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
            $form_result->addError(new FormError('Une erreur est survenue lors de l\'ajout de l\'adresse'));
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
            $form_result->addError(new FormError('Une erreur est survenue lors de l\'ajout de la résidence'));
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

        if ($form_result->hasErrors()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/residence');
        } else {
            Session::remove(Session::FORM_RESULT);
            Session::set(Session::FORM_SUCCESS, $form_result);
            self::redirect('/manage-listings');
        }
    }
}
