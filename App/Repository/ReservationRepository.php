<?php

namespace App\Repository;


use Core\Repository\Repository;
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















}