<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\NewsModel;
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
        $datanews = new NewsModel();
        foreach($items as $i){
            $title = $i->title;
            $pubDate = $i->pubDate;
            $url=$i->link;
            $guid = $i->guid;
            $description = $i->description;
            $y=$y+1;
            //CLI::write($pubDate);
            CLI::write($y." - ".$title." guid ".$guid." -Date ".$pubDate." description ".$description."-----fuente----".$url);
            $newdatanews = $datanews->findGuid($guid);
            if($newdatanews){
                $update=array(
                    'id'=>$newdatanews->id,
                    'title'=>$title,
                    'pubDate'=>$pubDate,
                    'url'=>$url,
                    'guid'=>$guid,
                    'description'=>$description,
                );
                $datanews->save($update);
            }else{
                $datanews->insert([
                    'title'=>$title,
                    'pubDate'=>$pubDate,
                    'url'=>$url,
                    'guid'=>$guid,
                    'description'=>$description,
                ]);
    
            }
        }
    }
    public function deletetable()
    {
        $table = new NewsModel();
        $table->db->table('news')->where('id>',0)->delete();
        $table->db->query("ALTER TABLE news AUTO_INCREMENT=1 ");

    }
}
