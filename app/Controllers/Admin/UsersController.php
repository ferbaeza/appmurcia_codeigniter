<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UsersController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Usuarios Admin Panel'
        ];
        return view('Administration/usersAll', $data);
    }
    public function getUsersData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $userM = new UsersModel();

        //Obtenemos los elementos que queremos mostrar
        $users = $userM->findUsersDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $userM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $users
        );

        return json_encode($json_data);
        

    }
}
