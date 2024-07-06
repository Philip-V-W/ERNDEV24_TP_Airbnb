<?php

namespace App\Model;

use Core\Model\Model;

class Favorite extends Model
{
    // Define properties for the Favorite class
    public int $id;
    public int $residence_id;
    public int $user_id;
    public bool $is_active;

    // Related objects
    public ?Residence $residence;
    public ?User $user;

    // Getter methods to provide access to the properties of an instance
    public function getId(): int
    {
        return $this->id;
    }

    public function getResidenceId(): int
    {
        return $this->residence_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getResidence(): ?Residence
    {
        return $this->residence;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
