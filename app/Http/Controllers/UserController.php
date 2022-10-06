<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\City2;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function search(Request $request)
    {

        return view('cities.index');
        // $cities = json_decode(file_get_contents(storage_path() . "/city.list.json"), true);

        // $citiesPL=[];
        // foreach($cities as $city) {
        //     if($city['country'] == "PL") {
        //         array_push($citiesPL, $city); 
        //     }
        // }
        
        

        // return view('add_city', [
        //     'citiesPL' => $citiesPL
        // ]);
        

        // if(isset($_GET['query'])){
        //     $search_text = $_GET['query'];
        //     $collection = collect($citiesPL);
        //     $search_citiesPL = $collection->where('name', $search_text);
        //     return view('add_city', [
        //         'search_cities' => $search_citiesPL
        //     ]);

        // } else {
        //     return view('add_city', [
        //         'cities' => $cities,
        //     ]);
        // } 
    }

    ## AJAX request
    public function getCities(Request $request)
    {
        $search = $request->search;

        if($search == '')
        {
            $cities = City2::orderby("name", "asc")
                    ->select("id","name")
                    ->limit(5)
                    ->get();
        } else {
            $cities = City2::orderby("name", "asc")
                    ->select("id","name")
                    ->where("name", "like", "%".$search."%")
                    ->limit(5)
                    ->get();
        }

        $response = array();
        foreach($cities as $city) {
            $response[] = array(
                "value" => $city->id,
                "label" => $city->name
            );
        }

        return response()->json($response);
    }


    public function store(Request $request)
    {
        if (City::where(['city_id' => $request->city_id, 'user_id' => Auth::user()->id])->first())
        {
            return redirect(route('add_city'));
        } else {
            $city = new City;
            $city->city_id = $request->city_id;
            $city->user_id = Auth::user()->id;
            $city->save();
            return redirect(route('dashboard'));
        }
    }

    public function my_cities()
    {
        $user_id = Auth::user()->id;
        
        return view('main_page', [
            'cities' => City::where('user_id', $user_id)->get()
        ]);
    }
}
