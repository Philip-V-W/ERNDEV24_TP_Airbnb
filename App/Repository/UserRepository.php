<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\User;

class UserRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'user';
    }

    /**
     * Adds a new user to the database.
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
        $query = sprintf('INSERT INTO %s (`email`, `password`, `lastname`, `firstname`, `is_active`) 
        VALUES (:email, :password, :lastname, :firstname, :is_active)',
            $this->getTableName());

        // Prepare the SQL query
        $stmt = $this->pdo->prepare($query);

        // Return null if statement preparation fails
        if (!$stmt) return null;

        // Execute the statement with the user data
        $stmt->execute($data);

        // Get the last inserted ID
        $id = $this->pdo->lastInsertId();

        // Return the newly created user object
        return $this->readById(User::class, $id);
    }

    /**
     * Finds a user by their email address.
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
        if (!$stmt) return null;

        // Execute the statement with the email parameter
        $stmt->execute(['email' => $email]);

        // Fetch the result and create a user object
        while ($result = $stmt->fetch()) {
            $user = new User($result);
        }

        // Return the user object or null if not found
        return $user ?? null;
    }
}