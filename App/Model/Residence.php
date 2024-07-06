<?php

namespace App\Model;

use Core\Model\Model;

class Residence extends Model
{
    // Define properties for the Residence class
    public int $id;
    public string $title;
    public ?string $description;
    public int $price_per_night;
    public int $size;
    public int $nb_rooms;
    public int $nb_beds;
    public int $nb_baths;
    public int $nb_guests;
    public bool $is_active;
    public ?int $type_id;
    public ?int $user_id;
    public ?int $address_id;

    // Related objects
    public ?Type $type;
    public ?User $user;
    public ?Address $address;

    // Getter methods to provide access to the properties of an instance
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPricePerNight(): int
    {
        return $this->price_per_night;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getNbRooms(): int
    {
        return $this->nb_rooms;
    }

    public function getNbBeds(): int
    {
        return $this->nb_beds;
    }

    public function getNbBaths(): int
    {
        return $this->nb_baths;
    }

    public function getNbGuests(): int
    {
        return $this->nb_guests;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getTypeId(): ?int
    {
        return $this->type_id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getAddressId(): ?int
    {
        return $this->address_id;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }
}
