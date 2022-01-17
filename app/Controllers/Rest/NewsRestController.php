<?php

namespace App\Controllers\Rest;

use CodeIgniter\RESTful\ResourceController as RESTfulResourceController;
use App\Models\NewsModel;

class NewsRestController extends RESTfulResourceController
{
    protected $category= "app\Models\NewsModel"; 
    protected $format= "json";

    public function index($id="")
    {
        try{
            $data= "Ups, algo ha fallado";
            $review = new NewsModel();
            $review = $review->findId($id);
            if($review != null){
                return $this->respond($review, 200, "Restaurante encontrado");
            }else{
                return $$this->respond($data, 404, "Tu consulta no existe");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }
}
