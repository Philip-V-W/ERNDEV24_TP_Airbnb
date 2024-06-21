<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\Type;
use Exception;
use PDO;

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

    public function findTypeById(int $id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->getTableName()} WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
        } catch (Exception $e) {
            error_log('Error finding type: ' . $e->getMessage());
            return null;
        }
    }

}