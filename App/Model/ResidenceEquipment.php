<?php

namespace App\Model;

use Core\Model\Model;

class ResidenceEquipment extends Model
{
    public int $residence_id;
    public int $equipment_id;

    public ?Residence $residence;
    public ?Equipment $equipment;
}