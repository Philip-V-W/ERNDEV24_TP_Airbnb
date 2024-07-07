<?php

namespace App\Controller;

use App\AppRepoManager;
use Core\Controller\Controller;
use Core\Session\Session;
use Exception;
use Laminas\Diactoros\ServerRequest;


class ReservationController extends Controller
{
    // Create a new reservation
    public function createReservation()
    {
    }

    // View a specific reservation
    public function viewReservation($reservationId)
    {
    }

    // Update a reservation
    public function updateReservation($reservationId)
    {
    }

    // Cancel a reservation
    public function cancelReservation($reservationId)
    {
    }

    // List all reservations (if applicable)
    public function listReservations()
    {
    }

    // Additional reservation-specific functionalities
    public function confirmReservation($reservationId)
    {
    }

    // Search for available reservations
    public function searchReservations()
    {
    }


    public function submitReservation(ServerRequest $request): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $dateStart = $data['date_start'] ?? null;
        $dateEnd = $data['date_end'] ?? null;
        $nbAdults = isset($data['nb_adults']) ? (int)$data['nb_adults'] : null;
        $nbChildren = isset($data['nb_children']) ? (int)$data['nb_children'] : null;
        $priceTotal = isset($data['price_total']) ? (int)$data['price_total'] : null;
        $residenceId = isset($data['residence_id']) ? (int)$data['residence_id'] : null;

        $user = Session::get(Session::USER);
        $userId = $user ? $user->id : null;

        if ($dateStart && $dateEnd && $nbAdults && $priceTotal && $residenceId && $userId) {
            $reservationRepository = AppRepoManager::getRm()->getReservationRepository();

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
                $result = $reservationRepository->createReservation($reservationData);

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