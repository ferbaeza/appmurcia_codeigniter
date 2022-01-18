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
            $data= "Ups, algo ha fallado";
            $wheather = new WeatherModel();
            $wheather = $wheather->findWeather();
            if($wheather != null){
                return $this->respond($wheather, 200, "Restaurante encontrado");
            }else{
                return $$this->respond($data, 400, "Tu consulta no existe");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }
}
