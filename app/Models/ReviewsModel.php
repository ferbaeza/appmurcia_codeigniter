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

    public function findId($id =null)
    {
        if(is_null($id)){
            return $this->findAll();
        }else  if($id==""){
           return $this->findAll();
        }else{
        return $this->where(['id'=>$id])
            ->first();
        }
    }
    public function findRevbymailandRest($email= null, $restaurant_id=null)
    {
        $cond = "email =  $email AND restaurant_id = $restaurant_id";
        return  $this->where($cond)->findAll();
    }
    public function findRestaId($restaurant_id= null)
    {
        if(is_null($restaurant_id)){
            return $this->findAll();
        }else{
            return $this->where(['restaurant_id'=>$restaurant_id])->first();
        }
    }
    public function redId($id =null)
    {
        if(is_null($id)){
            return $this->findAll();
        }else{
        return $this->where(['id'=>$id])
            ->first();
        }
    }



    

}
