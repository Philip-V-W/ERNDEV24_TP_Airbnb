<?php

namespace App\Model;

use Core\Model\Model;

class Equipment extends Model
{
    // Define properties for the Equipment class
    public int $id;
    public string $label;
    public ?string $image_path;

    // Getter methods to provide access to the properties of an instance
    public function getId(): int
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }
}
