<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\Residence;

class ResidenceRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'residence';
    }

    /**
     * méthode qui permet d'ajouter une nouvelle pizza
     * @param array $data
     * @return ?int
     */
    public function insertResidence(array $data): ?int
    {
        //on crée la requete SQL
        $q = sprintf(
            'INSERT INTO `%s` (`title`, `description`, `price_per_night`, `nb_rooms`, 
                   `nb_beds`, `nb_baths`, `nb_guests`, `is_active`, `type_id`, `user_id`, `address_id`)
            VALUES (:title, :description, :price_per_night, :nb_rooms, 
                    :nb_beds, :nb_baths, :nb_guests, :is_active, :type_id, :user_id, :address_id)',
            $this->getTableName()
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);

        //on vérifie que la requete est bien préparée
        if (!$stmt) return null;

        //on execute la requete en passant les paramètres
        $stmt->execute($data);

        //on retourne l'id de la pizza insérée
        return $this->pdo->lastInsertId();
    }
}