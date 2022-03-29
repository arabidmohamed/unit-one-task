<?php

namespace App\Http\Controllers;





use Goutte\Client;

use App\Models\Home;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ScraperController extends Controller
{
    //

    public function scraper()
    {

 
        // $href = 'https://summerhomes.com/property-alanya?city=190';
        // $href = 'https://summerhomes.com/kestel?city=190&district=195';
        $href = 'https://summerhomes.com/kargicak?city=190&district=201';


        
        $client = new Client();
        $crawler = $client->request('GET', $href);



        $crawler = $crawler->filter('.property-list-area .propert-item ')->each(function ($node) {
            $node->children()->each(function ($child) {

                $description = $child->children()->eq(0)->children()->eq(1)->filter('div p')->html();

                $room_count =  $child->children()->eq(0)->children()->eq(1)->filter('span')->eq(1)->text();

                $price = $child->children()->eq(0)->children()->eq(1)->filter('.card-title')->text();
                $size = $child->children()->eq(0)->children()->eq(1)->filter('span')->eq(0)->text();
                $city =  $child->children()->eq(0)->children()->eq(1)->filter('span')->eq(2)->text();

     

                $home_id = DB::table('homes')->insertGetId([
                    'agent_name' => $city,
                    'price' => ltrim($price, '€'),
                    'size' => $size,
                    'city' => $city,
                    'created_at' =>now()
                ]);

                $covered_image = $child->children()->eq(0)->filter('picture img')->attr('src');
                $contents = file_get_contents($covered_image);
                $name = substr($covered_image, strrpos($covered_image, '/') + 1);
                Storage::put($name, $contents);

                $image_id = DB::table('images')->insert([
                    'is_covered' => 1,
                    'url' =>  $name,
                    'home_id' => $home_id,
                    'created_at' =>now()

                ]);


                $property_id = DB::table('properties')->insert([
                    'description' => $description,
                    'rooms_count' =>  $room_count,
                    'home_id' => $home_id,
                    'created_at' =>now()

                ]);

                

           
                // $child->children()->filter('picture')->each(function ($child,$home_id) {   

                //     $other_image = $child->attr('src');
                //     // echo $other_image;
                //     // $contents = file_get_contents($other_image);
                //     // $name = substr($other_image, strrpos($other_image, '/') + 1);
                //     // Storage::put($name, $contents,'others');
    
                //     // $id = DB::table('images')->insert([
                //     //     'is_covered' => 0,
                //     //     'url' =>  $name,
                //     //     'home_id' => $home_id,
                //     // ]);
                // });


            });
        });
        dd('saved suucessfully');
   

    }
}
