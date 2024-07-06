<?php

namespace App\Model;

use Core\Model\Model;

class Type extends Model
{
    // Define properties for the Type class
    public int $id;
    public string $label;
    public ?string $image_path;
    public bool $is_active;

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

    public function isActive(): bool
    {
        return $this->is_active;
    }
}
