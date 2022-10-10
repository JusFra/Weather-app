<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\City2;
use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function search()
    {
        return view('cities.index');
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

            $selected_city_id = DB::table('cities')->latest('created_at')->first()->id;
            
            $key = config('weather.api_key');
            $url = config('weather.api_url');
                
            $response = Http::get($url.$request->city_id.'&appid='.$key.'&units=metric');
            $temp = $response['main']['temp'];
            $humidity = $response['main']['humidity'];            
            $name = $response['name'];
                
            $cart = ['selected_city_id' => $selected_city_id, 'name' => $name, 'temp' => $temp, 'humidity' => $humidity];
            $weather = Weather::create($cart);

            return redirect(route('dashboard'));
        }
    }

    public function my_cities()
    {
        $user_id = Auth::user()->id;
        $count = City::where('user_id', $user_id)->count();
        
        return view('main_page', [
            'weather' => DB::table('weather')
            ->join('cities', 'weather.selected_city_id', '=', 'cities.id')
            ->where('user_id', $user_id)
            ->orderBy('weather.created_at', 'DESC')
            ->limit($count)
            ->get()
        ]);
    }

    public function plot($id)
    {
        $result = DB::table('weather')
        ->where('selected_city_id', $id)
        ->limit(48)
        ->get();
        $data = "";

        foreach($result as $val)
        {
            $data.= "['".$val->created_at."', ".$val->temp.", ".$val->humidity."],";
            $name = $val->name;
        }
        
        return view('weather_plot', compact('data'), compact('name'));
    }
}
