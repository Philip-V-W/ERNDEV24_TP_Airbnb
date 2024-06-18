<?php

namespace App\Repository;

use App\Model\User;
use Core\Repository\Repository;
use App\Model\Address;

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
     * Méthode pour récupérer tous les Adresses actifs rangés par catégorie
     * @return array $data
     * @return Address|null
     */
    public function getAddressesByUserId($data): ?Address
    {
        // on delare un tableau vide
        $data = [];

        $query = sprintf('INSERT INTO %s (`address`, `city`, `zip_code`, `country`)
                             VALUES (:address, :city, :zip_code, :country)',
            $this->getTableName()
        );

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
}