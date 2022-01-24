<?php namespace App\Libraries;

class Utils {

  public function getDateInputFormat($date){
    return $this->attributes['date'] = date('Y-m-d H:i:s', strtotime($date));
  }

  public function getResponse($status="", $message="",$data=""){
    $response = array(
        "status" => $status,
        "message" => $message,
        "data" =>$data,
    );

    return json_encode($response);
  }

  public function comprobarRol($rol){
      if($rol==1){
          return true;
      }return false;
  }

}