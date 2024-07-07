<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\Reservation;
use PDO;
use PDOException;

class ReservationRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     *
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'reservation';
    }

    /**
     * Creates a new reservation in the database.
     *
     * @param array $data The data of the reservation to create.
     * @return bool True if the reservation was successfully created, false otherwise.
     */
    public function createReservation(array $data): bool
    {
        $q = "
            INSERT INTO reservation (date_start, date_end, nb_adults, nb_children, price_total, residence_id, user_id)
            VALUES (:date_start, :date_end, :nb_adults, :nb_children, :price_total, :residence_id, :user_id)
        ";

        $stmt = $this->pdo->prepare($q);

        try {
            return $stmt->execute($data);
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Finds reservations for a specific user's residences.
     *
     * @param int $userId The ID of the user.
     * @return array An array of reservations.
     */
    public function findReservationsByUserId(int $userId): array
    {
        $query = "
            SELECT 
                r.*, 
                u.firstname AS guest_firstname, 
                u.lastname AS guest_lastname, 
                u.email AS guest_email,
                res.title AS residence_title
            FROM reservation r
            JOIN residence res ON r.residence_id = res.id
            JOIN user u ON r.user_id = u.id
            WHERE res.user_id = :user_id
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Finds reservations made by a specific user.
     *
     * @param int $userId The ID of the user.
     * @return array An array of reservations.
     */
    public function findReservationsMadeByUserId(int $userId): array
    {
        $query = "
            SELECT 
                r.*, 
                h.firstname AS host_firstname, 
                h.lastname AS host_lastname,
                res.title AS residence_title,
                r.date_start,
                r.date_end,
                r.nb_adults,
                r.nb_children,
                r.price_total
            FROM reservation r
            JOIN residence res ON r.residence_id = res.id
            JOIN user h ON res.user_id = h.id
            WHERE r.user_id = :user_id AND res.user_id != :user_id
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cancels a reservation by its ID.
     *
     * @param int $id The ID of the reservation to cancel.
     * @return bool True if the reservation was successfully canceled, false otherwise.
     */
    public function cancelReservation(int $id): bool
    {
        $query = "DELETE FROM reservation WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Finds reservation details by its ID.
     *
     * @param int $id The ID of the reservation.
     * @return ?array An array of reservation details or null if not found.
     */
    public function findReservationDetailsById(int $id): ?array
    {
        $query = "
            SELECT 
                r.*, 
                u.firstname AS guest_firstname, 
                u.lastname AS guest_lastname, 
                u.email AS guest_email,
                res.title AS residence_title
            FROM reservation r
            JOIN residence res ON r.residence_id = res.id
            JOIN user u ON r.user_id = u.id
            WHERE r.id = :id
        ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;
    }
}
