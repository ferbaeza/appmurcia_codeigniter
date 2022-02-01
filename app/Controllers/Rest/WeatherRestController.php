<?php

namespace App\Controllers\Rest;

use CodeIgniter\RESTful\ResourceController as RESTfulResourceController;
use App\Models\WeatherModel;

class WeatherRestController extends RESTfulResourceController
{
    protected $category= "app\Models\WeatherModel"; 
    protected $format= "json";

    public function index()
    {
        try{
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $weather = new WeatherModel();
            $weather = $weather->findId();
            if($weather != null){
                return $this->respond($weather, 200, "Weather encontrado");
            }else{
                return $this->respond($data, 404, "Tu consulta no existe");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }
}
