<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GasStationModel;

class GasController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Gasolineras Admin Panel'
        ];
        return view('Administration/gasAll', $data);
    }
    public function getGasData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $gasM = new GasStationModel();

        //Obtenemos los elementos que queremos mostrar
        $gasStations = $gasM->findGasDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $gasM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $gasStations
        );

        return json_encode($json_data);
        

    }
}
