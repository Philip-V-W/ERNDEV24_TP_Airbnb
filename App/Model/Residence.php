<?php

namespace App\Model;

use Core\Model\Model;

class Residence extends Model
{
    public string $title;
    public ?string $description;
    public string $price_per_night;
    public ?int $nb_rooms;
    public ?int $nb_beds;
    public ?int $nb_baths;
    public ?int $nb_travelers;
    public bool $is_active;
    public ?int $type_id;
    public ?int $user_id;
    public ?int $address_id;

    public ?Type $type;
    public ?User $user;
    public ?Address $address;
}

