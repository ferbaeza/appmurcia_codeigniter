<?php

namespace App\Models;

use App\Entities\RestaurantEntity;
use CodeIgniter\Model;
use App\Entities\RestaurantsEntity;

class RestaurantsModel extends Model
{
    protected $table            = 'restaurants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = RestaurantEntity::class;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['name','description', 'address', 'latitud', 'longitud', 'reviewAverage', 'numReviews' ];

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
    public function findName($id=null)
    {
        if(is_null($id)){
            return $this->findAll();
        }else{
            $name = $this->where(['id' => $id])->first();
            return $name;
        }
    }

    public function findRestaurantsDatatable($limitStart, $limitLenght) {
        return $this->limit($limitLenght, $limitStart)
                    ->find();
    }

    

}
