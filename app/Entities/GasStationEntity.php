<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class GasStationEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    protected $attributes = [
        'id'=>null,
        'label'=>null,
        'address'=>null,
        'latitud'=>null,
        'longitud'=>null,
        'ideess'=>null,
    ];

}
