<?php

namespace App\Controllers\Rest;

use App\Entities\ReviewsEntity;
use App\Models\RestaurantsModel;
use CodeIgniter\RESTful\ResourceController as RESTfulResourceController;
use App\Models\ReviewsModel;

class ReviewRestController extends RESTfulResourceController
{
   
    protected $category= "app\Models\ReviewsModel"; 
    protected $format= "json";

    public function index($email="",$restaurante_id="")
    {
        try{
            $data= "Ups, algo ha fallado, tu consulta no existe";
            $review = new ReviewsModel();
            $review = $review->findReview($email,$restaurante_id);
            if($review != null){
                return $this->respond($review, 200, "Review encontrada");
            }else{
                return $this->respond($data, 404, "Tu consulta no existe");
            }

        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }

    public function all($id="")
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
    public function deleteReview()
    {
        try{
            $body = $this->request->getJSON();
            $rev = new ReviewsModel();
            $review= $rev->findId($body->id);
            if($review){
                $rev->delete(['id'=>$body->id]);
                return $this->respond($review, 200, "Review ".$body->id." eliminada correctamente");
            }else{
                return $this->respond("La review solicitada no ha sido encontrada",200,"La review solicitada no ha sido encontrada");
            }

        }catch(\Exception $e){
            return $this->respond("KO, Error grave en el servidor", 500, "KO, Error grave en el servidor");
        }


    }

    public function editCreateReview()
    {
        try{
            
            $body=$this->request->getJSON();
            $review = new ReviewsModel();

            if(isset($body->id)){
                
                $reviews = $review->findId($body->id);
                if ($reviews) {
                    
                    $data=array(
                        "id"=>$body->id,
                        'description'=>$body->description,
                        'puntuation'=>$body->puntuation,
                        'email'=>$body->email,
                        'restaurant_id'=>$body->restaurant_id
                    );
                    $review->save($data);

                    $restaurante = new RestaurantsModel();
                    $restauranteAct=$restaurante->findId($body->restaurant_id);
                    //$restaurante->actualizarRestaurant($data['restaurant_id'],$reviewAverage,$numReviews);

                    $reviewAverage=$review->contarReviewAverage($body->restaurant_id);

                    $data=array(
                        "id"=>$body->restaurant_id,
                        'name'=>$restauranteAct->name,
                        'description'=>$restauranteAct->description,
                        'address'=>$restauranteAct->address,
                        'latitud'=>$restauranteAct->latitud,
                        'longitud'=>$restauranteAct->longitud,
                        "reviewAverage"=>$reviewAverage->puntuation,
                        "numReviews"=>$restauranteAct->description
                    );

                    $restaurante->save($data);
                    return $this->respond($data,200,"Review actualizada con exito.");

                } else {
                    if($body->restaurant_id){
                        return $this->respond("La review que intenta modificar no se encuentra",404,"La review que intenta modificar no se encuentra.");
                    }else{
                        return $this->respond("",404,"La review que intenta modificar no se encuentra.");
                    }
                }
            } else {
                if ($body->restaurant_id && $body->email && $body->description && $body->puntuation){
                    $data = array(
                        "restaurant_id" => $body->restaurant_id,
                        "email" => $body->email,
                        "description" => $body->description,
                        "puntuation" => $body->puntuation
                    );
                    $newReview = new ReviewsEntity($data);
                    $review->save($newReview);

                    $reviewAverage=$review->contarReviewAverage($data['restaurant_id']);
                    $numReviews=$review->contarNumeroReviews($data['restaurant_id']);

                    $restaurante = new RestaurantsModel();
                    $restauranteAct=$restaurante->findId($data['restaurant_id']);
                    //$restaurante->actualizarRestaurant($data['restaurant_id'],$reviewAverage,$numReviews);

                    $data=array(
                        "id"=>$data['restaurant_id'],
                        'name'=>$restauranteAct->name,
                        'description'=>$restauranteAct->description,
                        'address'=>$restauranteAct->address,
                        'latitud'=>$restauranteAct->latitud,
                        'longitud'=>$restauranteAct->longitud,
                        "reviewAverage"=>$reviewAverage->puntuation,
                        "numReviews"=>$numReviews
                    );
                    $restaurante->save($data);

                    return $this->respond($data, 200, 'Review creada con exito');  
                }else{
                    return $this->respond("",400,"Falta algun dato");
                }
            }
        }catch(\Exception $e){
            return $this->respond($e->getMessage(), 500, "KO, Error grave en el servidor");
        }
    }

    
}
