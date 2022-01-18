<?php

namespace App\Controllers\Rest;

use CodeIgniter\RESTful\ResourceController as RESTfulResourceController;
use App\Models\ReviewsModel;

class ReviewRestController extends RESTfulResourceController
{
   
    protected $category= "app\Models\ReviewsModel"; 
    protected $format= "json";

    public function index($id="")
    {
        try{
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $review = new ReviewsModel();
            $review = $review->findId($id);
            if($review != null){
                return $this->respond($review, 200, "Review encontrada");
            }else{
                return $this->respond($data, 404, "Tu consulta no existe");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }

    public function restaId($id)
    {
        try{
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $review = new ReviewsModel();
            $review = $review->findRestaId($id);
            if($id!=null){
                if($review != null){
                    return $this->respond($review, 200, "Review encontrada");
                }else{
                    return $this->respond($data, 404, "Tu consulta no existe");
                }  
            }else{
                return $this->respond($data, 400, "No se ha pasado el id del Restaurante");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }

    public function reviewId($id="")
    {
        try{
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $review = new ReviewsModel();
            $review = $review->redId($id);
            if($id=== "" || $id=null){
                return $this->respond($data, 400, "No se ha pasado el id del Restaurante");
            }else{
                if($review != null){
                    return $this->respond($review, 200, "Review encontrada");
                }else{
                    return $this->respond($data, 404, "Tu consulta no existe");
                }  
            }
                

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }


    public function bymail($mail, $restaurant_id)
    {
        try{
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $review = new ReviewsModel();
            $review = $review->findMail($mail);
            if($review != null){
                $review = $review->findRestaId($restaurant_id);
                if($review != null){
                    return $this->respond($review, 200, "Review encontrada");
                }else{
                    return $this->respond($data, 404, "Tu consulta no existe");
                }
            }else{
                return $this->respond($data, 400, "Algo hay mal en los campos introducidos");
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }

    
}
