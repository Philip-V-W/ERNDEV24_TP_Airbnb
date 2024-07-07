<?php

namespace App\Repository;

use App\Model\User;
use Core\Repository\Repository;
use App\Model\Address;
use Exception;
use PDO;

class AddressRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'address';
    }


    /**
     * Function that adds an address to the database.
     * @param array $data The data of the address to add.
     * @return ?int The ID of the added address or null if the operation fails.
     */
    public function insertAddress(array $data): ?int
    {
        // SQL query to insert a new address
        $q = sprintf('INSERT INTO `%s` (`address`,`city`, `zip_code`, `country`) 
                             VALUES (:address, :city, :zip_code, :country)',
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

    /**
     * Function to find an address by its ID.
     * @param int $id The ID of the address to find.
     * @return ?Address The found address or null if not found.
     */
    public function findAddressById(int $id): ?Address
    {
        try {
            $q = sprintf('SELECT * FROM %s WHERE `id` = :id', $this->getTableName());

            $stmt = $this->pdo->prepare($q);

            if (!$stmt) return null;

            $stmt->execute(['id' => $id]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, Address::class);

            return $stmt->fetch();

        } catch (Exception $e) {
            error_log("Error finding address by ID: " . $e->getMessage());
            return null;
        }
    }
}