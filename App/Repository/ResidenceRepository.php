<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\User;
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
     * Function to find a residence by its ID.
     * @param int $id The ID of the residence to find.
     * @return ?Residence The found residence or null if not found.
     */
    public function findResidenceById(int $id): ?Residence
    {
        try {
            $q = sprintf('SELECT * FROM %s WHERE `id` = :id', $this->getTableName());

            $stmt = $this->pdo->prepare($q);

            if (!$stmt) return null;

            $stmt->execute(['id' => $id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ? new Residence($result) : null;

        } catch (Exception $e) {
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
    public function updateResidenceById(int $id, array $data): bool
    {
        try {
            // SQL query to update a residence
            $q = sprintf(
                'UPDATE %s SET 
                `title` = :title, 
                `description` = :description, 
                `price_per_night` = :price_per_night, 
                `size` = :size,
                `nb_rooms` = :nb_rooms,
                `nb_beds` = :nb_beds,
                `nb_baths` = :nb_baths,
                `nb_guests` = :nb_guests,
                `type_id` = :type_id,
                `address` = :address,
                `city` = :city,
                `zip` = :zip,
                `country` = :country
            WHERE `id` = :id',
                $this->getTableName()
            );

            // Prepare the SQL query
            $stmt = $this->pdo->prepare($q);

            // Return false if statement preparation fails
            if (!$stmt) return false;

            // Execute the statement with the residence data
            return $stmt->execute([
                'title' => $data['title'],
                'description' => $data['description'],
                'price_per_night' => $data['price_per_night'],
                'size' => $data['size'],
                'nb_rooms' => $data['nb_rooms'],
                'nb_beds' => $data['nb_beds'],
                'nb_baths' => $data['nb_baths'],
                'nb_guests' => $data['nb_guests'],
                'type_id' => $data['type_id'],
                'address' => $data['address'],
                'city' => $data['city'],
                'zip' => $data['zip'],
                'country' => $data['country'],
                'id' => $id,
            ]);

        } catch (Exception $e) {
            // Handle any exceptions and log the error if needed
            error_log("Error updating residence: " . $e->getMessage());
            return false;
        }
    } // TODO: fix

    /**
     * Function to delete a residence by its ID.
     * @param int $id The ID of the residence to delete.
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function deleteResidenceById(int $id): bool
    {
        try {
            $this->pdo->beginTransaction();

            // Delete related records in the residence_equipment table
            $stmt = $this->pdo->prepare('DELETE FROM residence_equipment WHERE residence_id = :id');
            $stmt->execute(['id' => $id]);

            // Delete related records in the media table
            $stmt = $this->pdo->prepare('DELETE FROM media WHERE residence_id = :id');
            $stmt->execute(['id' => $id]);

            // Delete the record in the residence table
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








    public function getAllListings(): array
    {
        $query = "
    SELECT
        r.id,
        r.title,
        r.price_per_night,
        u.firstname AS user_firstname,
        u.lastname AS user_lastname,
        m.image_path
    FROM residence r
    JOIN user u ON r.user_id = u.id
    LEFT JOIN media m ON r.id = m.residence_id
    WHERE r.is_active = 1
    ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Group listings by residence id and aggregate images
        $listings = [];
        foreach ($results as $result) {
            if (!isset($listings[$result['id']])) {
                $listings[$result['id']] = [
                    'id' => $result['id'],
                    'title' => $result['title'],
                    'price_per_night' => $result['price_per_night'],
                    'user_firstname' => $result['user_firstname'],
                    'user_lastname' => $result['user_lastname'],
                    'images' => []
                ];
            }
            if ($result['image_path']) {
                $listings[$result['id']]['images'][] = $result['image_path'];
            }
        }

        // Flatten the associative array to pass to the view
        return array_values($listings);
    }











}