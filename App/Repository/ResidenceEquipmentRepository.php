<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\ResidenceEquipment;
use PDO;

class ResidenceEquipmentRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'residence_equipment';
    }

    public function findEquipmentIdsByResidenceId(int $residenceId): array
    {
        $query = sprintf('SELECT equipment_id FROM %s WHERE residence_id = :residence_id', $this->getTableName());
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['residence_id' => $residenceId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}