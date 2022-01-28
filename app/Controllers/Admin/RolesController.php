<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RolesModel;

class RolesController extends BaseController
{
    public function index()
    {
        $data=[
            'title'=>'Roles Admin Panel'
        ];
        return view('Administration/rolesAll', $data);
    }
    public function getRolesData()
    {
        $request = $this->request;

        //Obtenemos datos que envía el datatable y que vamos a necesitar
        $limitStart = $request->getVar("start");
        $limitLength =$request->getVar("length");
        $draw = $request->getVar("draw");

        $rolM = new RolesModel();

        //Obtenemos los elementos que queremos mostrar
        $roles = $rolM->findRolesDatatable($limitStart,$limitLength);

        //Obtenemos los elementos totales de la tabla
        $totalRecords = $rolM->countAllResults();

        $json_data = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $roles
        );

        return json_encode($json_data);
        

    }
}
