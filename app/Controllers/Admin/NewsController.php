<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class NewsController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Noticias Admin Panel'
        ];
        return view('Administration/newsAll', $data);
    }
    public function getNewsData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $newsM = new NewsModel();

        //Obtenemos los elementos que queremos mostrar
        $news = $newsM->findNewsDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $newsM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $news
        );

        return json_encode($json_data);

    }
    public function showNewsData($id=""){
 
        //Si llega corectamente el id estaremos editando
        $newsM =new NewsModel();

        $news = $newsM->findId($id);
        if(is_null($news))
            throw PageNotFoundException::forPageNotFound();
        
        //Cambio el titulo y le paso el festival que quiero editar
        $data["title"]="Informacion Noticia"; 
        $data["noticias"]=$news;
      
        return view ("Administration/show_news", $data);
    }
}
