<?php

namespace App\Model;

use Core\Model\Model;

class Address extends Model
{
    // Define properties for the Address class
    public int $id;
    public string $address;
    public string $city;
    public string $zip_code;
    public string $country;

    // Getter methods to provide access to the properties of an instance
    public function getId(): int
    {
        return $this->id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZipCode(): string
    {
        return $this->zip_code;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}
