<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UsersEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    protected $attributes = [
        'id'=>null,
        'username'=>null,
        'email'=>null,
        'password'=>null,
        'name'=>null,
        'surname'=>null,
        'rol_id'=>null,
    ];

}
