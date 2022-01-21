<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class VideosEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    protected $attributes = [
        'id'=>null,
        'title'=>null,
        'pubDate'=>null,
        'url'=>null,
        'guid'=>null,
        'description'=>null,
    ];

    

}
