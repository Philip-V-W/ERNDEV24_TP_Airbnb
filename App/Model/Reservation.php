<?php

namespace App\Model;

use Core\Model\Model;

class Reservation extends Model
{
    public string $date_start;
    public string $date_end;
    public ?int $nb_adults;
    public ?int $nb_children;
    public int $price_total;
    public ?int $residence_id;
    public ?int $user_id;

    public ?Residence $residence;
    public ?User $user;
}