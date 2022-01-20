<?php

namespace App\Controllers\Command;

use CodeIgniter\CLI\CLI;
use App\Controllers\BaseController;
use App\Models\GasStationModel;
use CodeIgniter\I18n\Time;

class StationsCommand extends BaseController
{
    public function index()
    {
        try{
            $gasstations = new GasStationModel();
            $today = new Time();
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
                    if ($el['Localidad']=='MURCIA'){
                        $label = $el['Rótulo'];
                        $provincia = $el['Provincia'];
                        $municipio = $el['Municipio'];
                        $latitud = $el['Latitud'];
                        $longitud = $el['Longitud (WGS84)'];
                        $ideess = $el['IDEESS'];
                        $address = $el['Dirección'];
                        $station = $gasstations->findIdeess($ideess);
                        //$station = $gasstations->where(['ideess'=>$ideess]);
                        if ($station){
                            $update=array(
                                'id'=>$station->id,
                                'label'=>$label,
                                'provincia'=>$provincia,
                                'municipio'=>$municipio,
                                'latitud'=>$latitud,
                                'longitud'=>$longitud,
                                'address'=>$address,
                            );
                            $gasstations->save($update);
                        }else{
                            $newstation = new GasStationModel();
                            $newstation->insert([
                                'label'=> $label,
                                'address'=>$address,
                                'latitud'=>str_replace(',','.',$latitud),
                                'longitud'=>str_replace(',','.',$longitud),
                                'ideess'=>$ideess,
                                'created_at'=>$today,
                                'updated_at'=>$today,
                            ]);
                        }
                        CLI::write($provincia." localidad ".$municipio." Latitud ".$latitud." Longitud ".$longitud." IDEESS ".$ideess." Direccion ".$address);
                    }
                }
    
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
        $table = new GasStationModel();
        $table->db->table('gasstation')->where('id>',0)->delete();
        $table->db->query("ALTER TABLE gasstation AUTO_INCREMENT=1 ");

    }




}
