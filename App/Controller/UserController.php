<?php

namespace App\Controller;

use App\AppRepoManager;
use Core\Controller\Controller;
use Core\Session\Session;
use Core\View\View;

class UserController extends Controller
{
    // Display the user's profile and listings.
    public function manageListings(): void
    {
        // Redirect to login-form if the user is not authenticated
        if (!AuthController::isAuth()) {
            self::redirect('/login-form');
        }

        // Get the current user from the session
        $user = Session::get(Session::USER);
        $userId = $user->id;

        // Get repositories
        $userRepository = AppRepoManager::getRm()->getUserRepository();
        $mediaRepository = AppRepoManager::getRm()->getMediaRepository();
        $reservationRepository = AppRepoManager::getRm()->getReservationRepository();

        // Fetch user's listings
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

        // Current date
        $date = new \DateTime();

        // Render the view with the gathered data
        $view = new View('home/manage-listings');
        $view->render([
            'user' => $user,
            'listings' => $listings,
            'photos' => $photos,
            'date' => $date,
            'reservations' => $reservations,
            'user_reservations' => $userReservations
        ]);
    }

    // Check if the user has any listings.
    public function userHasListings(int $userId): bool
    {
        $userRepository = AppRepoManager::getRm()->getUserRepository();
        $listings = $userRepository->findByUserId($userId);
        return !empty($listings);
    }
}
