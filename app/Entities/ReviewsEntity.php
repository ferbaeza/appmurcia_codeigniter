<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ReviewsEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    protected $attributes = [
        'id'=>null,
        'description'=>null,
        'puntuation'=>null,
        'email'=>null,
        'restaurant_id'=>null,
    ];

}
