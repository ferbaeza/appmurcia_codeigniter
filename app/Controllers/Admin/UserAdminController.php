<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UserAdminController extends BaseController
{
    public function index()
    {
        $data=array(
            "title"=>"Inicio",
        );
        
        return view("Administration/home_admin",$data);
    
    }
}
