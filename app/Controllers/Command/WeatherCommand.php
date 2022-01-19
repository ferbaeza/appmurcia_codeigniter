<?php

namespace App\Controllers\Command;
use CodeIgniter\CLI\CLI;
use App\Controllers\BaseController;
use App\Models\WeatherModel;

class WeatherCommand extends BaseController
{
    public function index()
    {
        try{
            $client= service('curlrequest');
            $response = $client->request("GET", "api.openweathermap.org/data/2.5/weather?q=Murcia&appid=83c0f1f02cf876689b19d9afb4d85901", []);
            $response->getStatusCode();
            CLI::write("Realizando tu consulta del estado del tiempo actual");
            if($response->getStatusCode()==200){
                CLI::write("Cargando datos...");
                $url = "api.openweathermap.org/data/2.5/weather?q=Murcia&appid=83c0f1f02cf876689b19d9afb4d85901";
                $curl = curl_init($url);
                //Api url y hacemos un curl a la API
                //Set el contenido en JSON
                curl_setopt($curl, CURLOPT_HTTPHEADER,  array('Content-Type:application/json') );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($curl);
                $data = json_decode($result, true);
                $wea= $data['weather'][0];
                $dataweather=array();
                foreach($wea as $el) {
                    array_push($dataweather, $el);
                    //CLI::write($el);
                }
                $todayweather= new WeatherModel();
                $todayweather->insert([
                    'main'=>$dataweather[1],
                    'description'=>$dataweather[2],
                    'icon'=>$dataweather[3],
                ]);
                CLI::write($dataweather[1]);
                CLI::write($dataweather[2]);
                CLI::write($dataweather[3]);
                
                curl_close($curl);
            }else{
                CLI::write("Peticion no disponible, error:" );
                CLI::write($response->getStatusCode());
            }
        }catch(\Exception $e){
            return CLI::write("API data no disponible".$e);
        }


    }
    public function deletetable()
    {
        $table = new WeatherModel();
        $table->db->table('weather')->where('id>',0)->delete();
        $table->db->query("ALTER TABLE weather AUTO_INCREMENT=1 ");

    }

}
