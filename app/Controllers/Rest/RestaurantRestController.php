<?php

namespace App\Controllers\Rest;

use CodeIgniter\RESTful\ResourceController as RESTfulResourceController;
use App\Models\RestaurantsModel;


class RestaurantRestController extends RESTfulResourceController
{
    protected $category= "app\Models\RestaurantsModel"; 
    protected $format= "json";

    public function index($id="")
    {
        try{
            $data= "Ups, algo ha fallado";
            $resto = new RestaurantsModel();
            $resto = $resto->findId($id);
            if($resto != null){
                return $this->respond($resto, 200, "Restaurante encontrado");
            }else{
                return $$this->respond($data, 404, "Tu consulta no existe");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }
}
