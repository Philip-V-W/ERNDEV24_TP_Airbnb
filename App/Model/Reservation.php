<?php

namespace App\Model;

use Core\Model\Model;

class Reservation extends Model
{
    // Define properties for the Reservation class
    public int $id;
    public string $date_start;
    public string $date_end;
    public ?int $nb_adults;
    public ?int $nb_children;
    public int $price_total;
    public ?int $residence_id;
    public ?int $user_id;

    // Related objects
    public ?Residence $residence;
    public ?User $user;

    // Getter methods to provide access to the properties of an instance
    public function getId(): int
    {
        return $this->id;
    }

    public function getDateStart(): string
    {
        return $this->date_start;
    }

    public function getDateEnd(): string
    {
        return $this->date_end;
    }

    public function getNbAdults(): ?int
    {
        return $this->nb_adults;
    }

    public function getNbChildren(): ?int
    {
        return $this->nb_children;
    }

    public function getPriceTotal(): int
    {
        return $this->price_total;
    }

    public function getResidenceId(): ?int
    {
        return $this->residence_id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
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
