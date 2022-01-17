<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\GasStationEntity;

class GasStationModel extends Model
{
    protected $table            = 'gasstation';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = GasStationEntity::class;
    protected $allowedFields    = ['label', 'address','latitud', 'longitud', 'ideess' ];

    // Dates
    protected $useSoftDeletes   = true;
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

}
