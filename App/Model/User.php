<?php

namespace App\Model;

use Core\Model\Model;

class User extends Model
{
    public string $email;
    public string $password;
    public string $firstname;
    public string $lastname;
    public string $phone;
    public string $is_active;
    public ?int $address_id;

    public ?Address $address;
}