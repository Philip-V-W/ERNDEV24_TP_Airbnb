<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\Reservation;

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

    /**
     * méthode qui permet de récupérer la dernière commande
     * @return ?int
     */
    public function findLastOrder(): ?int
    {
        $q = sprintf(
            'SELECT * 
            FROM `%s` 
            ORDER BY id DESC 
            LIMIT 1',
            $this->getTableName()
        );

        $stmt = $this->pdo->query($q);

        if (!$stmt) return null;

        $result = $stmt->fetchObject();

        return $result->id ?? 0;
    }
}