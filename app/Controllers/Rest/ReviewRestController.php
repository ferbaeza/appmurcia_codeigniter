<?php

namespace App\Controllers\Rest;

use App\Models\RestaurantsModel;
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

    public function restaId($id="")
    {
        try{
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $resta = new ReviewsModel();
            $resta = $resta->findRestaId($id);
            if($id ==="" || $id==null){
                return $this->respond($data, 400, "No se ha pasado el id del Restaurante");
            }else{
                if($resta!=null){
                    return $this->respond($resta, 200, "Tu consulta no existe");
                }else{
                    return $this->respond($data, 404, "Tu consulta no existe");
             }
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
            if($id=== "" || $id==null){
                return $this->respond($data, 400, "No se ha pasado el id de la review");
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


    public function bymailandId($email=null, $restaurant_id=null)
    {
        try{
            //dd($email);
            //dd($restaurant_id);
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $reviewmailq = new ReviewsModel();
            $restaurante = new RestaurantsModel();
            if($email==null || $restaurant_id==null){
                return $this->respond("Tienes que introducir todos los campos", 400, "Tienes que introducir todos los campos");
            }else{
                //dd($email);
                $resta = $restaurante->findId($restaurant_id);
                if($resta){    
                    $reviewmail = $reviewmailq->findRevbymailandRest($email, $restaurant_id);
                    if($reviewmail){
                        return $this->respond($reviewmail, 200, "Review encontrada");
                    }else{
                        return $this->respond("Algo hay mal en los campos introducidos", 400, "Algo hay mal en los campos introducidos");
                    }
                }else{
                    return $this->respond("El restaurante que has pasado no existe", 404, "El restaurante que has pasado no existe");
                }
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }

    
}
