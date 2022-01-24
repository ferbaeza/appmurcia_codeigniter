<?php

namespace App\Models;

use App\Entities\UsersEntity;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = UsersEntity::class;
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['username', 'email', 'password', 'name', 'surname', 'rol_id'];

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

    public function findUsers($username=null){
        
        $response = $this->where(['username' => $username])->orWhere(['email' => $username])->first();

        return $response;
    }


}
