<?php

namespace App\Repository;


use Core\Repository\Repository;
use PDO;
use PDOException;


class ReservationRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'reservation';
    }





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


    public function cancelReservation(int $id): bool
    {
        $query = "DELETE FROM reservation WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(['id' => $id]);
    }


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