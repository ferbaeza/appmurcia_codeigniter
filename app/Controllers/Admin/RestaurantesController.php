<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RestaurantsModel;

class RestaurantesController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Restaurants Admin Panel'
        ];
        return view('Administration/restaurantesAll', $data);
    }
    public function getRestaurantesData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $restM = new RestaurantsModel();

        //Obtenemos los elementos que queremos mostrar
        $restaurantes = $restM->findRestaurantsDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $restM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $restaurantes
        );

        return json_encode($json_data);
        

    }
}
