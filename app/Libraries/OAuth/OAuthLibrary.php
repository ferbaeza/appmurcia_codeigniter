<?php 

namespace App\Libraries\OAuth;

class OauthLibrary {

    public $server;

    //Conexion base de datos
    protected $dsn;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->dsn = "";
        $this->username = "";
        $this->password = "";
    }

}