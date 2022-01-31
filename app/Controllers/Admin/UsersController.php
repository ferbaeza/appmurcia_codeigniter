<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\UsersEntity;
use App\Libraries\Utils;
use App\Models\RolesModel;
use App\Models\UsersModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\UserAgents;

class UsersController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Usuarios Admin Panel'
        ];
        return view('Administration/usersAll', $data);
    }
    public function getUsersData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $userM = new UsersModel();

        //Obtenemos los elementos que queremos mostrar
        $users = $userM->findUsersDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $userM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $users
        );

        return json_encode($json_data);
    
    }

    public function newEditUser($id=""){
        
        if(strcmp($id,"")===0){

            //Si no llega el id estoy creando
            $data["title"]="Nuevo usuario";
            $data["user"]=new UsersEntity();
            $rolM= new RolesModel();
            $data['roles']= $rolM->findId();

        }else{
            
            //Si llega corectamente el id estaremos editando
            $userM =new UsersModel();

            $user = $userM->findId($id);
            if(is_null($user))
                throw PageNotFoundException::forPageNotFound();
            
            //Cambio el titulo y le paso el festival que quiero editar
            $data["title"]="Editar user"; 
            $data["user"]=$user;
            $rolM= new RolesModel();
            $data['roles']= $rolM->findId();

        }
        
        return view ("Administration/new_edit_users", $data);
    }


    public function saveUser()
    {   
        try {
            $util = new Utils();
            $userM = new UsersModel();
            $request = $this->request;
            $data= [
                "id"=>$request->getVar("id"),
                "username"=>$request->getVar("username"),
                "email"=>$request->getVar("email"),
                "password"=>$request->getVar("password"),
                "name"=>$request->getVar("name"),
                "surname"=>$request->getVar("surname"),
                "rol_id"=>$request->getVar("rol_id"),  
            ];
            //dd($data);
            if(strcmp($data['id'],"")!==0){
                //dd($data);
                //var_dump($data);
                $user = $userM->findId($data["id"]);
                if(is_null($user))
                    return $util->getResponse("KO_NOT_FOUND", "El festival que quieres editar no esta en la BBDD");
            }else{
                $user = new UsersEntity();
            }
            $user->fill($data);
            $userM->save($user);
            return $util->getResponse("Ok", "Festival guardado correctamente");
            
        }catch(\Exception $e){
            return $util->getResponse("KO", "Se ha producido un error", $e);

        }   
    }

    public function deleteUser()
    {
        try{
            $request = $this->request;
            $data = $request->getJSON();
            $id = $data->id;

            $userM = new UsersModel();
            $util = new Utils();

            $user = $userM->findId($id);
            if($user){
                $review= $userM->delete(['id'=>$id]);
                return $response = $util->getResponse($user , 200 , "Festival deleted");
            }else{
                return $response = $util->getResponse($user , 404 , "Festival  not found");
            }
        }catch(\Exception $e){
                return $response = $util->getResponse(null , 500 , "Error grave del servidor");
        }
        return($response);
    }

}
