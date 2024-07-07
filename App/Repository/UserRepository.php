<?php

namespace App\Repository;

use App\Model\Residence;
use Core\Repository\Repository;
use App\Model\User;
use Exception;
use PDO;

class UserRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     *
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'user';
    }

    /**
     * Adds a new user to the database.
     *
     * @param array $data The data of the user to add.
     * @return User|null The added user object or null if the operation fails.
     */
    public function addUser(array $data): ?User
    {
        // Additional data to be added to the user
        $data_more = [
            'is_active' => 1
        ];
        $data = array_merge($data, $data_more);

        // SQL query to insert a new user
        $query = sprintf(
            'INSERT INTO %s (`email`, `password`, `lastname`, `firstname`, `phone`, `is_active`) 
             VALUES (:email, :password, :lastname, :firstname, :phone, :is_active)',
            $this->getTableName()
        );

        // Prepare the SQL query
        $stmt = $this->pdo->prepare($query);

        // Return null if statement preparation fails
        if (!$stmt) {
            return null;
        }

        // Execute the statement with the user data
        $stmt->execute($data);

        // Get the last inserted ID
        $id = (int)$this->pdo->lastInsertId();

        // Return the newly created user object
        return $this->readById(User::class, $id);
    }

    /**
     * Finds a user by their email address.
     *
     * @param string $email The email address to search for.
     * @return User|null The user object or null if not found.
     */
    public function findUserByEmail(string $email): ?User
    {
        // SQL query to find a user by email
        $q = sprintf('SELECT * FROM %s WHERE `email` = :email', $this->getTableName());

        // Prepare the SQL query
        $stmt = $this->pdo->prepare($q);

        // Return null if statement preparation fails
        if (!$stmt) {
            return null;
        }

        // Execute the statement with the email parameter
        $stmt->execute(['email' => $email]);

        // Fetch the result and create a user object
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the user object or null if not found
        return $result ? new User($result) : null;
    }

    /**
     * Finds residences by user ID.
     *
     * @param int $userId The user ID to find residences for.
     * @return array The list of residences.
     */
    public function findByUserId(int $userId): array
    {
        try {
            $q = sprintf('SELECT * FROM residence WHERE `user_id` = :user_id');
            $stmt = $this->pdo->prepare($q);

            if (!$stmt) {
                error_log("Statement preparation failed.");
                return [];
            }

            $stmt->execute(['user_id' => $userId]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Raw results from DB: " . print_r($results, true)); // Debugging line

            $residences = [];
            foreach ($results as $result) {
                $residences[] = new Residence($result);
            }

            error_log("Constructed Residence objects: " . print_r($residences, true)); // Debugging line
            return $residences;
        } catch (Exception $e) {
            error_log("Error finding residences by user ID: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Fetches a user by their ID.
     *
     * @param int $id The ID of the user.
     * @return User|null The user object or null if not found.
     */
    public function fetchUserById(int $id): ?User
    {
        $q = sprintf('SELECT * FROM %s WHERE `id` = :id', $this->getTableName());

        $stmt = $this->pdo->prepare($q);

        if (!$stmt) {
            return null;
        }

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? new User($result) : null;
    }
}
