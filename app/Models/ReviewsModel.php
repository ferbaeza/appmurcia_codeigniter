<?php

namespace App\Models;

use App\Entities\ReviewsEntity;
use CodeIgniter\Model;

class ReviewsModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = ReviewsEntity::class;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['description','puntuation', 'email', 'restaurant_id' ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    

    

}
