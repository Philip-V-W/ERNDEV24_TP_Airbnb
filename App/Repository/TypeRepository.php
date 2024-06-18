<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\Type;

class TypeRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'type';
    }

    /**
     * Function that adds a new type to the database.
     * @param array $data The data of the address to add.
     * @return ?int The ID of the added address or null if the operation fails.
     */
    public function insertType(array $data): ?int
    {
        // SQL query to insert a new address
        $q = sprintf('INSERT INTO `%s` (`label`, `image_path`, `is_active`)
            VALUES (:label, :image_path, :is_active)',
            $this->getTableName()
        );


        // Prepare the SQL query
        $stmt = $this->pdo->prepare($q);

        // Return null if statement preparation fails
        if (!$stmt) return null;

        // Execute the statement with the address data
        $stmt->execute($data);

        // Get the last inserted ID
        return $this->pdo->lastInsertId();
    }
}