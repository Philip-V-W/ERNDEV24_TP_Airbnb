<?php

namespace App\Model;

use Core\Model\Model;

class Type extends Model
{
    public string $label;
    public ?string $image_path;
    public int $is_active;
}