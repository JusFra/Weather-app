<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function search(Request $request)
    {
        // $url = 'https://bulk.openweathermap.org/sample/city.list.json.gz';
        $cities = json_decode(file_get_contents(storage_path() . "/city.list.json"), true);
        // $response = Http::get(($url));
        // $cities = $response->gzdecode()->json_decode();
        // echo "<pre>";
        // print_r($cities);

        if(isset($_GET['query'])){
            $search_text = $_GET['query'];
            $collection = collect($cities);
            $search_cities = $collection->where('name','LIKE', $search_text);
            return view('add_city', ['search_cities' => $search_cities]);

        } else {
            return view('add_city', [
                'cities' => $cities,
            ]);
        } 
    }


    public function store(Request $request)
    {
        $city = new City;
        $city->city_id = $request->city_id;
        $city->user_id = Auth::user()->id;
        $city->save();

        return redirect(route('dashboard'));
    }

    public function my_cities()
    {
        $user_id = Auth::user()->id;
        
        return view('main_page', [
            'cities' => City::where('user_id', $user_id)->get()
        ]);
    }
}
