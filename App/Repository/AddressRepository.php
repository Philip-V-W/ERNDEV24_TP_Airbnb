<?php

namespace App\Repository;

use App\Model\Address;
use Core\Repository\Repository;
use Exception;
use PDO;

class AddressRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     *
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'address';
    }

    /**
     * Adds an address to the database.
     *
     * @param array $data The data of the address to add.
     * @return ?int The ID of the added address or null if the operation fails.
     */
    public function insertAddress(array $data): ?int
    {
        // SQL query to insert a new address
        $q = sprintf(
            'INSERT INTO `%s` (`address`, `city`, `zip_code`, `country`) 
             VALUES (:address, :city, :zip_code, :country)',
            $this->getTableName()
        );

        // Prepare the SQL query
        $stmt = $this->pdo->prepare($q);

        // Return null if statement preparation fails
        if (!$stmt) {
            return null;
        }

        // Execute the statement with the address data
        $stmt->execute($data);

        // Get the last inserted ID
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Finds an address by its ID.
     *
     * @param int $id The ID of the address to find.
     * @return ?Address The found address or null if not found.
     */
    public function findAddressById(int $id): ?Address
    {
        try {
            // SQL query to find the address by ID
            $q = sprintf('SELECT * FROM %s WHERE `id` = :id', $this->getTableName());

            // Prepare the SQL query
            $stmt = $this->pdo->prepare($q);

            // Return null if statement preparation fails
            if (!$stmt) {
                return null;
            }

            // Execute the statement with the address ID
            $stmt->execute(['id' => $id]);

            // Set the fetch mode to fetch an Address object
            $stmt->setFetchMode(PDO::FETCH_CLASS, Address::class);

            // Fetch and return the address object
            return $stmt->fetch();
        } catch (Exception $e) {
            // Log the error and return null
            error_log("Error finding address by ID: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Updates an address by its ID.
     *
     * @param int $id The ID of the address to update.
     * @param array $data The data to update the address with.
     * @return bool True if the update was successful, false otherwise.
     */
    public function updateAddressById(int $id, array $data): bool
    {
        try {
            // SQL query to update the address by ID
            $q = sprintf(
                'UPDATE %s SET 
                `address` = :address, 
                `city` = :city, 
                `zip_code` = :zip_code, 
                `country` = :country 
                WHERE `id` = :id',
                $this->getTableName()
            );

            // Prepare the SQL query
            $stmt = $this->pdo->prepare($q);

            // Return false if statement preparation fails
            if (!$stmt) {
                return false;
            }

            // Execute the statement with the updated address data
            return $stmt->execute([
                'address' => $data['address'],
                'city' => $data['city'],
                'zip_code' => $data['zip_code'],
                'country' => $data['country'],
                'id' => $id
            ]);
        } catch (Exception $e) {
            // Log the error and return false
            error_log("Error updating address: " . $e->getMessage());
            return false;
        }
    }
}
