<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\NewsEntity;

class NewsModel extends Model
{
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = NewsEntity::class;
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

    public function findone()
    {      
        return $this->first();  
        //return $this->db->query("SELECT * FROM news ORDER BY id DESC LIMIT 1");
        //return $this->getLastRow('array');
    }
    
    public function findGuid($guid=null){
        if(is_null($guid)){
            return $this->findAll();
        }else{
            return $this->where(['guid'=>$guid])
            ->first();
        }
    }

    public function findNewsDatatable($limitStart, $limitLenght) {
        return $this->limit($limitLenght, $limitStart)
                    ->find();
    }


}
