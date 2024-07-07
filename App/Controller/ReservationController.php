<?php

namespace App\Controller;

use App\AppRepoManager;
use Core\Controller\Controller;
use Core\Session\Session;
use Exception;
use Laminas\Diactoros\ServerRequest;

class ReservationController extends Controller
{
    /**
     * Cancel a reservation.
     *
     * @param ServerRequest $request The server request object.
     * @param int $id The reservation ID.
     */
    public function cancelReservation(ServerRequest $request, int $id): void
    {
        // Retrieve the current user from the session
        $user = Session::get(Session::USER);
        if (!$user) {
            self::redirect('/login-form');
            return;
        }

        $reservationRepository = AppRepoManager::getRm()->getReservationRepository();

        // Fetch the reservation details to ensure the user is authorized
        $reservation = $reservationRepository->findReservationDetailsById($id);

        if (!$reservation) {
            Session::set('flash_error', 'Reservation not found');
            self::redirect('/manage-listings');
            return;
        }

        // Check if the user is authorized to cancel this reservation
        if ($reservation['user_id'] !== $user->id) {
            Session::set('flash_error', 'You are not authorized to cancel this reservation');
            self::redirect('/manage-listings');
            return;
        }

        // Attempt to cancel the reservation
        $result = $reservationRepository->cancelReservation($id);
        if ($result) {
            Session::set('flash_success', 'Reservation cancelled successfully');
        } else {
            Session::set('flash_error', 'Failed to cancel reservation');
        }

        self::redirect('/manage-listings');
    }

    /**
     * Submit a reservation.
     *
     * @param ServerRequest $request The server request object.
     */
    public function submitReservation(ServerRequest $request): void
    {
        // Decode JSON input from the request body
        $data = json_decode(file_get_contents('php://input'), true);

        // Extract and validate input data
        $dateStart = $data['date_start'] ?? null;
        $dateEnd = $data['date_end'] ?? null;
        $nbAdults = isset($data['nb_adults']) ? (int)$data['nb_adults'] : null;
        $nbChildren = isset($data['nb_children']) ? (int)$data['nb_children'] : null;
        $priceTotal = isset($data['price_total']) ? (int)$data['price_total'] : null;
        $residenceId = isset($data['residence_id']) ? (int)$data['residence_id'] : null;

        // Retrieve the current user from the session
        $user = Session::get(Session::USER);
        $userId = $user ? $user->id : null;

        // Ensure all required fields are present
        if ($dateStart && $dateEnd && $nbAdults && $priceTotal && $residenceId && $userId) {
            $reservationRepository = AppRepoManager::getRm()->getReservationRepository();

            // Prepare reservation data
            $reservationData = [
                'date_start' => $dateStart,
                'date_end' => $dateEnd,
                'nb_adults' => $nbAdults,
                'nb_children' => $nbChildren,
                'price_total' => $priceTotal,
                'residence_id' => $residenceId,
                'user_id' => $userId
            ];

            try {
                // Attempt to create the reservation
                $result = $reservationRepository->createReservation($reservationData);

                // Respond with success or error
                if ($result) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['error' => 'Failed to create reservation']);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => 'Server error']);
            }
        } else {
            echo json_encode(['error' => 'Invalid input']);
        }
    }
}
