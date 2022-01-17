<?php

namespace App\Controllers\Rest;

use CodeIgniter\RESTful\ResourceController as RESTfulResourceController;
use App\Models\GasStationModel;

class GasStationRestController extends RESTfulResourceController
{
    protected $category= "app\Models\GasStationModel"; 
    protected $format= "json";

    public function index($id="")
    {
        try{
            $data= "Ups, algo ha fallado";
            $gas = new GasStationModel();
            $gas = $gas->findId($id);
            if($gas != null){
                return $this->respond($gas, 200, "Restaurante encontrado");
            }else{
                return $$this->respond($data, 404, "Tu consulta no existe");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }
}
