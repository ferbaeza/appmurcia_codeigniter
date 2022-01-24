<?php

namespace App\Controllers\PublicSection;

use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function index()
    {
        $session= session();
        $session->destroy();
        
        return redirect()->route("login");
    }
}
