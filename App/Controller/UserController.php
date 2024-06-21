<?php

namespace App\Controller;

use App\AppRepoManager;
use Core\Controller\Controller;
use Core\Session\Session;
use Core\View\View;
use Exception;
use Laminas\Diactoros\ServerRequest;

class UserController extends Controller
{
    public function manageListings(): void
    {
        if (!AuthController::isAuth()) {
            self::redirect('/login-form');
        }

        $userId = Session::get(Session::USER)->id;
        $residenceRepository = AppRepoManager::getRm()->getResidenceRepository();
        $listings = $residenceRepository->findByUserId($userId);

        $view = new View('home/manage-listings');
        $view->render(['listings' => $listings]);
    }

    public function editResidence(ServerRequest $request, int $id): void
    {
        if (!AuthController::isAuth()) {
            self::redirect('/login-form');
        }

        $residenceRepository = AppRepoManager::getRm()->getResidenceRepository();
        $listing = $residenceRepository->findById($id);

        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();
            $updatedData = [
                'title' => htmlspecialchars($data['title']),
                'description' => htmlspecialchars($data['description']),
                'price_per_night' => floatval($data['price_per_night']),
            ];

            $residenceRepository->update($id, $updatedData);
            self::redirect('/manage-listings');
        }

        $view = new View('home/edit-listings');
        $view->render(['listing' => $listing]);
    }

    public function deleteResidence(ServerRequest $request, int $id): void
    {
        if (!AuthController::isAuth()) {
            self::redirect('/login-form');
        }

        try {
            $residenceRepository = AppRepoManager::getRm()->getResidenceRepository();
            $residenceRepository->deleteById($id);
            self::redirect('/manage-listings'); // Ensure this redirect path is correct
        } catch (Exception $e) {
            error_log("Error deleting residence: " . $e->getMessage());
            echo "Error deleting residence: " . $e->getMessage(); // For debugging purposes
        }
    }
}
