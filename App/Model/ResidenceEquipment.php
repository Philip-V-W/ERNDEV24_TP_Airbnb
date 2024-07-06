<?php

namespace App\Model;

use Core\Model\Model;

class ResidenceEquipment extends Model
{
    // Define properties for the ResidenceEquipment class
    public int $residence_id;
    public int $equipment_id;

    // Related objects
    public ?Residence $residence;
    public ?Equipment $equipment;

    // Getter methods to provide access to the properties of an instance
    public function getResidenceId(): int
    {
        return $this->residence_id;
    }

    public function getEquipmentId(): int
    {
        return $this->equipment_id;
    }

    public function getResidence(): ?Residence
    {
        return $this->residence;
    }

    public function getEquipment(): ?Equipment
    {
        return $this->equipment;
    }
}
