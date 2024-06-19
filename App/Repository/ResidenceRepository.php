<?php

namespace App\Repository;

use App\AppRepoManager;
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
     * Function that adds a new residence to the database.
     * @param array $data The data of the residence to add.
     * @return ?int The ID of the added residence or null if the operation fails.
     */
    public function insertResidence(array $data): ?int
    {

        // SQL query to insert a new residence
        $q = sprintf('INSERT INTO `%s` (`title`, `description`, `price_per_night`, `size`, `nb_rooms`, 
                             `nb_beds`, `nb_baths`, `nb_guests`, `is_active`, `type_id`, `user_id`, `address_id`) 
                             VALUES (:title, :description, :price_per_night, :size, :nb_rooms, 
                             :nb_beds, :nb_baths, :nb_guests, :is_active, :type_id, :user_id, :address_id)',
            $this->getTableName()
        );

        // Prepare the SQL query
        $stmt = $this->pdo->prepare($q);

        // Return null if statement preparation fails
        if (!$stmt) return null;

        // Execute the statement with the residence data
        $stmt->execute($data);

        // Get the last inserted ID
        return $this->pdo->lastInsertId();
    }
}