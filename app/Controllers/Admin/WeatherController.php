<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WeatherModel;

class WeatherController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Weather Admin Panel'
        ];
        return view('Administration/weatherAll', $data);
    }
    public function getWeatherData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $weM = new WeatherModel();

        //Obtenemos los elementos que queremos mostrar
        $weather = $weM->findWeatherDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $weM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $weather
        );

        return json_encode($json_data);
        

    }
}
