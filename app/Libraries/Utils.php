<?php namespace App\Libraries;

class Utils {

  public function getDateInputFormat($date){
    return $this->attributes['date'] = date('Y-m-d H:i:s', strtotime($date));
  }

}