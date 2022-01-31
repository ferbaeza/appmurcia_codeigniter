<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\ReviewsEntity;
use App\Libraries\Utils;
use App\Models\RestaurantsModel;
use App\Models\ReviewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ReviewController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Reviews Admin Panel'
        ];
        return view('Administration/reviewsAll', $data);
    }
    public function getReviewData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $reviM = new ReviewsModel();

        //Obtenemos los elementos que queremos mostrar
        $review = $reviM->findReviewDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $reviM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $review
        );

        return json_encode($json_data);
        
    }

    public function newEditReview($id=""){
        
        if(strcmp($id,"")===0){

            //Si no llega el id estoy creando
            $data["title"]="Nueva Review";
            $data["review"]=new ReviewsEntity();
            $restauranteM= new RestaurantsModel();
            $data['restaurante']= $restauranteM->findId();

        }else{
            
            //Si llega corectamente el id estaremos editando
            $reviewM =new ReviewsModel();

            $review = $reviewM->findId($id);
            if(is_null($review))
                throw PageNotFoundException::forPageNotFound();
            
            //Cambio el titulo y le paso el festival que quiero editar
            $data["title"]="Editar review"; 
            $data["review"]=$review;
            $restauranteM= new RestaurantsModel();
            $data['restaurante']= $restauranteM->findId();

        }
        
        return view ("Administration/new_edit_review", $data);
    }


    public function saveReview()
    {   
        try {
            $util = new Utils();
            $reviewM= new ReviewsModel();
            $request = $this->request;
            $data= [
                "id"=>$request->getVar("id"),
                "description"=>$request->getVar("description"),
                "puntuation"=>$request->getVar("puntuation"),
                "email"=>$request->getVar("email"),
                "restaurant_id"=>$request->getVar("restaurant_id"),
            ];
            //dd($data);
            if(strcmp($data['id'],"")!==0){
                //dd($data);
                //var_dump($data);
                $review = $reviewM->findId($data["id"]);
                if(is_null($review))
                    return $util->getResponse("KO_NOT_FOUND", "El festival que quieres editar no esta en la BBDD");
            }else{
                $review = new ReviewsEntity();
            }
            $review->fill($data);
            $reviewM->save($review);
            return $util->getResponse("Ok", "Festival guardado correctamente");
            
        }catch(\Exception $e){
            return $util->getResponse("KO", "Se ha producido un error", $e);

        }   
    }

    public function deleteReview()
    {
        try{
            $request = $this->request;
            $data = $request->getJSON();
            $id = $data->id;

            $reviewM = new ReviewsModel();
            $util = new Utils();

            $review = $reviewM->findId($id);
            if($review){
                $review= $reviewM->delete(['id'=>$id]);
                return $response = $util->getResponse($review , 200 , "Festival deleted");
            }else{
                return $response = $util->getResponse($review , 404 , "Festival  not found");
            }
        }catch(\Exception $e){
                return $response = $util->getResponse(null , 500 , "Error grave del servidor");
        }
        return($response);
    }

   
}
