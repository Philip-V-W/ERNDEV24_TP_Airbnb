<?php

namespace App\Model;

use Core\Model\Model;

class User extends Model
{
    // Define properties for the User class
    public int $id;
    public string $email;
    public string $password;
    public string $lastname;
    public string $firstname;
    public string $phone;
    public bool $is_active;
    public ?int $address_id;

    // Related object
    public ?Address $address;

    // Getter methods to provide access to the properties of an instance
    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getAddressId(): ?int
    {
        return $this->address_id;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }
}
