<?php

namespace App\Repository;

use Core\Repository\Repository;
use App\Model\ResidenceEquipment;

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
}