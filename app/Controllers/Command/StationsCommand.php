<?php

namespace App\Controllers\Command;

use CodeIgniter\CLI\CLI;
use App\Controllers\BaseController;

class StationsCommand extends BaseController
{
    public function index()
    {
        try{
            $client= service('curlrequest');
            $response = $client->request("GET", "https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/", []);
            $response->getStatusCode();
            CLI::write("Realizando peticion de gasolineras");
            if($response->getStatusCode()==200){
                CLI::write("Cargando datos...");
                $url = "https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/";
                $curl = curl_init($url);
                //Api url y hacemos un curl a la API
                //Set el contenido en JSON
                curl_setopt($curl, CURLOPT_HTTPHEADER,  array('Content-Type:application/json') );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curl);
                $result = json_decode($result, true);
                $data= $result['ListaEESSPrecio'];
                //$local=$ess['Localidad'];
                foreach($data as $el) {
                    if ($el['Provincia']=='MURCIA'){
                        $provincia = $el['Provincia'];
                        $municipio = $el['Municipio'];
                        $latitud = $el['Latitud'];
                        $longitud = $el['Longitud (WGS84)'];
                        $ideess = $el['IDEESS'];
                        $address = $el['Dirección'];
                        //$cp = $el['C.P.'];
                        CLI::write($provincia." localidad ".$municipio." Latitud ".$latitud." Longitud ".$longitud." IDEESS ".$ideess." Direccion ".$address);
                    }
                }
                // for ($i=0; $i< 1000 ;$i ++){
                //     $data = $data[$i][''];
                //     CLI::write($data);
                // }
                
    
                curl_close($curl);
            }else{
                CLI::write("Peticion no disponible, error:" );
                CLI::write($response->getStatusCode());
            }
    
        }catch(\Exception $e){
            return CLI::write("API data no disponible".$e);
        }


    }
}
