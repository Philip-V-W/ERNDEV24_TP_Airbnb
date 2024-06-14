<?php

namespace App\Model;

use Core\Model\Model;

class Favorite extends Model
{
    public int $residence_id;
    public int $user_id;
    public bool $is_active;

    public ?Residence $residence;
    public ?User $user;
}