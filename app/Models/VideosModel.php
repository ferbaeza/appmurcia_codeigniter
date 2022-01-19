<?php

namespace App\Models;

use App\Entities\VideosEntity;
use CodeIgniter\Model;

class VideosModel extends Model
{
    protected $table            = 'videos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = VideosEntity::class;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['title', 'pubDate', 'url', 'guid', 'description'];

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
    public function findGuid($guid=null){
        if(is_null($guid)){
            return $this->findAll();
        }else{
            return $this->where(['guid'=>$guid])
            ->first();
        }
    }


}
