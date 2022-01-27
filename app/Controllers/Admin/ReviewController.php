<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReviewsModel;

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
}
