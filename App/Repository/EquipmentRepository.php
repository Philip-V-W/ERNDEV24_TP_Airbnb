<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\Equipment;
use PDO;

class EquipmentRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'equipment';
    }

    public function getAllEquipment(): array
    {
        $q = sprintf('SELECT `id`, `label`, `image_path` FROM `%s`', $this->getTableName());
        $stmt = $this->pdo->prepare($q);
        if (!$stmt) return [];

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEquipmentIds(): array
    {
        $q = sprintf('SELECT `id` FROM `%s`', $this->getTableName());
        $stmt = $this->pdo->prepare($q);
        if (!$stmt) return [];

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function insertResidenceEquipment(array $data): void
    {
        $q = sprintf('INSERT INTO `residence_equipment` (`residence_id`, `equipment_id`) VALUES (:residence_id, :equipment_id)');
        $stmt = $this->pdo->prepare($q);
        $stmt->execute($data);
    }



}