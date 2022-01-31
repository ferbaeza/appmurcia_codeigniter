<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\RestaurantEntity;
use App\Libraries\Utils;
use App\Models\RestaurantsModel;
use App\Models\RolesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class RestaurantesController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Restaurants Admin Panel'
        ];
        return view('Administration/restaurantesAll', $data);
    }
    public function getRestaurantesData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $restM = new RestaurantsModel();

        //Obtenemos los elementos que queremos mostrar
        $restaurantes = $restM->findRestaurantsDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $restM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $restaurantes
        );

        return json_encode($json_data);
        
    }
    public function newEditRestaurante($id=""){
        
        if(strcmp($id,"")===0){

            //Si no llega el id estoy creando
            $data["title"]="Nuevo restaurante";
            $data["restaurante"]=new RestaurantEntity();

        }else{
            
            //Si llega corectamente el id estaremos editando
            $restM =new RestaurantsModel();

            $restaurante = $restM->findId($id);
            if(is_null($restaurante))
                throw PageNotFoundException::forPageNotFound();
            
            //Cambio el titulo y le paso el festival que quiero editar
            $data["title"]="Editar restaurante"; 
            $data["restaurante"]=$restaurante;

        }
        
        return view ("Administration/new_edit_restaurante", $data);
    }


    public function saveRestaurante()
    {   
        try {
            $util = new Utils();
            $restM = new RestaurantsModel();
            $request = $this->request;
            $data= [
                "id"=>$request->getVar("id"),
                "name"=>$request->getVar("name"),
                "description"=>$request->getVar("description"),
                "address"=>$request->getVar("address"),
                "latitud"=>$request->getVar("latitud"),
                "longitud"=>$request->getVar("longitud"),
                "reviewAverage"=>$request->getVar("reviewAverage"),
                "numReviews"=>$request->getVar("numReviews"),
            ];
            //dd($data);
            if(strcmp($data['id'],"")!==0){
                //dd($data);
                //var_dump($data);
                $restaurante = $restM->findId($data["id"]);
                if(is_null($restaurante))
                    return $util->getResponse("KO_NOT_FOUND", "El festival que quieres editar no esta en la BBDD");
            }else{
                $restaurante = new RestaurantEntity();
            }
            $restaurante->fill($data);
            $restM->save($restaurante);
            return $util->getResponse("Ok", "Festival guardado correctamente");
            
        }catch(\Exception $e){
            return $util->getResponse("KO", "Se ha producido un error", $e);

        }   
    }

    public function deleteRestaurante()
    {
        try{
            $request = $this->request;
            $data = $request->getJSON();
            $id = $data->id;

            $restM = new RestaurantsModel();
            $util = new Utils();

            $restaurante = $restM->findId($id);
            if($restaurante){
                $restaurante= $restM->delete(['id'=>$id]);
                return $response = $util->getResponse($restaurante , 200 , "Festival deleted");
            }else{
                return $response = $util->getResponse($restaurante , 404 , "Festival  not found");
            }
        }catch(\Exception $e){
                return $response = $util->getResponse(null , 500 , "Error grave del servidor");
        }
        return($response);
    }

}
