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

        $user = Session::get(Session::USER);
        $userId = $user->id;
        $userRepository = AppRepoManager::getRm()->getUserRepository();
        $mediaRepository = AppRepoManager::getRm()->getMediaRepository();
        $reservationRepository = AppRepoManager::getRm()->getReservationRepository();

        // Fetch listings from the user repository
        $listings = $userRepository->findByUserId($userId);

        // Fetch reservations for the user's listings
        $reservations = $reservationRepository->findReservationsByUserId($userId);

        // Fetch reservations made by the user on other listings
        $userReservations = $reservationRepository->findReservationsMadeByUserId($userId);

        // Fetch media for each listing
        $photos = [];
        foreach ($listings as $listing) {
            $listingPhotos = $mediaRepository->findByResidenceId($listing->id);
            $photos[$listing->id] = $listingPhotos;
        }

        $date = new \DateTime();

        $view = new View('home/manage-listings');
        $view->render([
            'user' => $user,
            'listings' => $listings,
            'photos' => $photos,
            'date' => $date,
            'reservations' => $reservations,
            'user_reservations' => $userReservations // Pass the new data to the view
        ]);
    }







    public function userHasListings($userId): bool
    {
        $userRepository = AppRepoManager::getRm()->getUserRepository();
        $listings = $userRepository->findByUserId($userId);
        return !empty($listings);
    }

    // Edit the user profile
    public function editProfile() {
        // Logic to edit user profile data
        $view = new View('user/edit_profile');
        $view->render(compact('user'));
    } //TODO: Potential future implementation

    // Delete the user profile
    public function deleteProfile() {
        // Logic to delete user profile data
        $this->redirect('/user/deleted');
    } //TODO: Potential future implementation



























    /**
     * Displays the login form.
     * @return void
     */
    public function becomeHost(): void
    {
        $view = new View('test/become_host');
        $view->render();
    }

    public function editProperty(): void
    {
        $view = new View('test/edit_property');
        $view->render();
    }

    public function index(): void
    {
        $view = new View('test/index');
        $view->render();
    }

    public function message(): void
    {
        $view = new View('test/message');
        $view->render();
    }

    public function photo(): void
    {
        $view = new View('test/photo');
        $view->render();
    }

    public function search(): void
    {
        $view = new View('test/search');
        $view->render();
    }

    public function show(): void
    {
        $view = new View('test/show');
        $view->render();
    }

    public function sponsorForm(): void
    {
        $view = new View('test/sponsor_form');
        $view->render();
    }

    public function sponsorFormUpdate(): void
    {
        $view = new View('test/sponsor_form_update');
        $view->render();
    }

    public function stats(): void
    {
        $view = new View('test/stats');
        $view->render();
    }
}
