<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class WeatherEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    protected $attributes = [
        'id'=>null,
        'main'=>null,
        'description'=>null,
        'icon'=>null,
    ];

}
