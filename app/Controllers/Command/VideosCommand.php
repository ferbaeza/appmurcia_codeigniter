<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use CodeIgniter\CLI\CLI;
use SimpleXMLElement;

class VideosCommand extends BaseController
{
    public function index()
    {
        $arrContextOptions=array(
            "ssl" => array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $response = file_get_contents("https://www.youtube.com/feeds/videos.xml?channel_id=UCBUAES-IbWw30H-dn-GyHag", false, stream_context_create($arrContextOptions));
        $data = new SimpleXMLElement($response);
        //Asi se imprime el objeto con todo lo que tiene dentro
        //CLI::write($response);
        $items = $data->entry;
        $y=0;
        foreach($items as $i){
            $title = $i->title;
            $id = $i->id;
            $name = $i->author->name;
            $pubDate = $i->published;
            //$description = $i->description;
            CLI::write($id."".$name."".$pubDate);
            $y=$y+1;
            //CLI::write($y." - ".$title." guid ".$guid." -Date ".$pubDate." description ".$description);
        }

    }
}
