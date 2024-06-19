<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\Type;

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


    public function getTypeIdByLabel(string $label): ?int
    {
        $q = sprintf('SELECT `id` FROM `%s` WHERE `label` = :label', $this->getTableName());
        $stmt = $this->pdo->prepare($q);
        if (!$stmt) return null;

        $stmt->execute(['label' => $label]);
        $result = $stmt->fetch();

        return $result ? (int)$result['id'] : null;
    }
}