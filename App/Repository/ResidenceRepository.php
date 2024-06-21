<?php

namespace App\Repository;

use App\AppRepoManager;
use Core\Repository\Repository;
use App\Model\Residence;
use Exception;
use PDO;

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

    /**
     * Function to find residences by user ID.
     * @param int $userId The user ID to find residences for.
     * @return array The list of residences.
     */
    public function findByUserId(int $userId): array
    {
        try {
            // SQL query to find listings by user ID
            $q = sprintf('SELECT * FROM %s WHERE `user_id` = :user_id', $this->getTableName());

            // Prepare the SQL query
            $stmt = $this->pdo->prepare($q);

            // Return an empty array if statement preparation fails
            if (!$stmt) return [];

            // Execute the statement with the user ID parameter
            $stmt->execute(['user_id' => $userId]);

            // Fetch all results and create Residence objects
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $residences = [];
            foreach ($results as $result) {
                $residences[] = new Residence($result);
            }

            // Return the array of Residence objects
            return $residences;

        } catch (Exception $e) {
            // Handle any exceptions and log the error if needed
            error_log("Error finding listings by user ID: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Function to find a residence by its ID.
     * @param int $id The ID of the residence to find.
     * @return ?Residence The found residence or null if not found.
     */
    public function findById(int $id): ?Residence
    {
        try {
            // SQL query to find a residence by ID
            $q = sprintf('SELECT * FROM %s WHERE `id` = :id', $this->getTableName());

            // Prepare the SQL query
            $stmt = $this->pdo->prepare($q);

            // Return null if statement preparation fails
            if (!$stmt) return null;

            // Execute the statement with the ID parameter
            $stmt->execute(['id' => $id]);

            // Fetch the result and create a Residence object
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Return the Residence object or null if not found
            return $result ? new Residence($result) : null;

        } catch (Exception $e) {
            // Handle any exceptions and log the error if needed
            error_log("Error finding residence by ID: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Function to update a residence by its ID.
     * @param int $id The ID of the residence to update.
     * @param array $data The data to update the residence with.
     * @return bool True if the update was successful, false otherwise.
     */
    public function update(int $id, array $data): bool
    {
        try {
            // SQL query to update a residence
            $q = sprintf('UPDATE %s SET `title` = :title, `description` = :description, `price_per_night` = :price_per_night WHERE `id` = :id', $this->getTableName());

            // Prepare the SQL query
            $stmt = $this->pdo->prepare($q);

            // Return false if statement preparation fails
            if (!$stmt) return false;

            // Execute the statement with the residence data
            return $stmt->execute([
                'title' => $data['title'],
                'description' => $data['description'],
                'price_per_night' => $data['price_per_night'],
                'id' => $id,
            ]);

        } catch (Exception $e) {
            // Handle any exceptions and log the error if needed
            error_log("Error updating residence: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Function to delete a residence by its ID.
     * @param int $id The ID of the residence to delete.
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function deleteById(int $id): bool
    {
        try {
            $this->pdo->beginTransaction();

            // Delete related records in residence_equipment table
            $stmt = $this->pdo->prepare('DELETE FROM residence_equipment WHERE residence_id = :id');
            $stmt->execute(['id' => $id]);

            // Delete record in residence table
            $stmt = $this->pdo->prepare('DELETE FROM residence WHERE id = :id');
            $stmt->execute(['id' => $id]);

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            error_log("Error deleting residence: " . $e->getMessage());
            return false;
        }
    }
}