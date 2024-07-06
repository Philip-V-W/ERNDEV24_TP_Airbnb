<?php

namespace App\Model;

use Core\Model\Model;

class Media extends Model
{
    // Define properties for the Media class
    public int $id;
    public ?string $image_path;
    public ?int $residence_id;

    // Related object
    public ?Residence $residence;

    // Getter methods to provide access to the properties of an instance
    public function getId(): int
    {
        return $this->id;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }

    public function getResidenceId(): ?int
    {
        return $this->residence_id;
    }

    public function getResidence(): ?Residence
    {
        return $this->residence;
    }
}
