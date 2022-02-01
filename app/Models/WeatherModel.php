<?php

namespace App\Models;

use CodeIgniter\Model;

class WeatherModel extends Model
{
    protected $table            = 'weather';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['main','description', 'icon'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function findId($id =null)
    {
        if(is_null($id)){
            return $this->first();
        }else  if($id==""){
           return $this->first();
        }else{
        return $this->where(['id'=>$id])
            ->first();
        }
    }
    public function findWeather()
    {
        return $this->first();
        
    }

    public function findWeatherDatatable($limitStart, $limitLenght) {
        return $this->limit($limitLenght, $limitStart)
                    ->find();
    }

}
