<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VideosModel;

class VideosController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Videos Admin Panel'
        ];
        return view('Administration/videosAll', $data);
    }
    public function getVideosData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $videoM = new VideosModel();

        //Obtenemos los elementos que queremos mostrar
        $video = $videoM->findVideosDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $videoM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $video
        );

        return json_encode($json_data);
        

    }
}
