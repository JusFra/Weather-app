<?php
  
namespace App\Http\Controllers;

use App\Models\City2;
use Illuminate\Http\Request;
use App\Models\Item;
  
class CityController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $cities = json_decode(file_get_contents(storage_path() . "/city.list.json"), true);
        $citiesPL=[];
        foreach($cities as $city) {
            if($city['country'] == "PL") {
                array_push($citiesPL, $city); 
            }
        }
        foreach($citiesPL as $cityPL){
            $cart = ['id' => $cityPL['id'], 'name' => $cityPL['name']];
            $cities = City2::create($cart);
        }
    }
}