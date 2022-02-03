<?php

namespace App\Controllers\Rest;

use App\Models\VideosModel;
use CodeIgniter\RESTful\ResourceController as RESTfulResourceController;

class VideosRestController extends RESTfulResourceController

{
    protected $category= "app\Models\RestaurantsModel"; 
    protected $format= "json";

    public function index()
    {
        try{
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $video = new VideosModel();
            $video = $video->findId();
            if($video != null){
                return $this->respond($video, 200, "Videos encontrado");
            }else{
                return $this->respond($data, 404, "Tu consulta no existe");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }

    public function oneVideo(){
        try{
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $video = new VideosModel();
            $video = $video->findone();
            if($video != null){
                return $this->respond($video, 200, "Videos encontrado");
            }else{
                return $this->respond($data, 404, "Tu consulta no existe");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }
}
