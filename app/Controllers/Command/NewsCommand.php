<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use CodeIgniter\CLI\CLI;
use SimpleXMLElement;


class NewsCommand extends BaseController
{
    public function index()
    {
        $arrContextOptions=array(
            "ssl" => array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $response = file_get_contents("https://www.laverdad.es/rss/2.0/portada", false, stream_context_create($arrContextOptions));
        $data = new SimpleXMLElement($response);
        //Asi se imprime el objeto con todo lo que tiene dentro
        //CLI::write($response);
        $items = $data->channel->item;
        $y=0;
        foreach($items as $i){
            $title = $i->title;
            $guid = $i->guid;
            $pubDate = $i->pubDate;
            $description = $i->description;

            $y=$y+1;
            CLI::write($y." - ".$title." guid ".$guid." -Date ".$pubDate." description ".$description);
        }
    }
}
