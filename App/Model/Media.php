<?php

namespace App\Model;

use Core\Model\Model;

class Media extends Model
{
    public ?string $image_path;
    public ?string $residence_id;

    public ?Residence $residence;
}