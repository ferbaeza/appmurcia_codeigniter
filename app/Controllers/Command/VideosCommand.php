<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\VideosModel;
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
        $n=1;
        $datavideo = new VideosModel();
        foreach($items as $i){
            $title = $i->title;
            $pubDate = $i->published;
            $url = $i->author->uri;
            $guid = $i->id;
            $media = $i->children("http://search.yahoo.com/mrss/");
            $description = $media->group->description;
            $n=$n+1;
            $y=$y+1;
            
            //CLI::write($description."----------------------------------".$n);
            CLI::write($y."".$title."###".$pubDate."<<<>>>".$url."--".str_replace("yt:video:","" ,$guid)."".$description);
            $newdatavideo= $datavideo->findGuid($guid);
            if ($newdatavideo){
                $update=array(
                    'id'=>$newdatavideo->id,
                    'title'=>$title,
                    'pubDate'=>$pubDate,
                    'url'=>$url,
                    'guid'=>str_replace("yt:video:","" ,$guid),
                    'description'=> $description,        //$description,
                );
                $datavideo->save($update);

            }else{
                $datavideo->insert([
                    'title'=>$title,
                    'pubDate'=>$pubDate,
                    'url'=>$url,
                    'guid'=>str_replace("yt:video:","" ,$guid),
                    'description'=>$description,
                ]);
            }            
        }

    }
    public function deletetable()
    {
        $table = new VideosModel();
        $table->db->table('videos')->where('id>',0)->delete();
        $table->db->query("ALTER TABLE videos AUTO_INCREMENT=1 ");

    }

}
