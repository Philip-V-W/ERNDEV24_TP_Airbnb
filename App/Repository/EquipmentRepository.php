<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\Equipment;
use PDO;

class EquipmentRepository extends Repository
{
    /**
     * Returns the name of the table associated with the repository.
     *
     * @return string The table name.
     */
    public function getTableName(): string
    {
        return 'equipment';
    }

    /**
     * Retrieves all equipment records from the database.
     *
     * @return array An array of all equipment records.
     */
    public function getAllEquipment(): array
    {
        $q = sprintf('SELECT `id`, `label`, `image_path` FROM `%s`', $this->getTableName());
        $stmt = $this->pdo->prepare($q);
        if (!$stmt) {
            return [];
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves all equipment IDs from the database.
     *
     * @return array An array of all equipment IDs.
     */
    public function getAllEquipmentIds(): array
    {
        $q = sprintf('SELECT `id` FROM `%s`', $this->getTableName());
        $stmt = $this->pdo->prepare($q);
        if (!$stmt) {
            return [];
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Inserts a residence-equipment association into the database.
     *
     * @param array $data The residence-equipment data to insert.
     */
    public function insertResidenceEquipment(array $data): void
    {
        $q = 'INSERT INTO `residence_equipment` (`residence_id`, `equipment_id`) VALUES (:residence_id, :equipment_id)';
        $stmt = $this->pdo->prepare($q);
        $stmt->execute($data);
    }

    /**
     * Finds equipment records by their IDs.
     *
     * @param array $ids The IDs of the equipment to find.
     * @return array An array of found equipment records.
     */
    public function findEquipmentsByIds(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $query = sprintf('SELECT * FROM %s WHERE `id` IN (%s)', $this->getTableName(), $placeholders);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($ids);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves equipment IDs associated with a specific residence.
     *
     * @param int $residenceId The ID of the residence.
     * @return array An array of equipment IDs associated with the residence.
     */
    public function getEquipmentsByResidenceId(int $residenceId): array
    {
        $stmt = $this->pdo->prepare('SELECT equipment_id FROM residence_equipment WHERE residence_id = :residence_id');
        $stmt->execute(['residence_id' => $residenceId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Updates the equipment associated with a specific residence.
     *
     * @param int $residenceId The ID of the residence.
     * @param array $selectedEquipments An array of selected equipment IDs.
     */
    public function updateResidenceEquipments(int $residenceId, array $selectedEquipments): void
    {
        // Delete existing equipment entries for the residence
        $stmt = $this->pdo->prepare('DELETE FROM residence_equipment WHERE residence_id = :residence_id');
        $stmt->execute(['residence_id' => $residenceId]);

        // Insert new equipment entries
        $stmt = $this->pdo->prepare('INSERT INTO residence_equipment (residence_id, equipment_id) VALUES (:residence_id, :equipment_id)');
        foreach ($selectedEquipments as $equipmentId) {
            $stmt->execute([
                'residence_id' => $residenceId,
                'equipment_id' => $equipmentId
            ]);
        }
    }
}
