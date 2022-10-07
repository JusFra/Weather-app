<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function save_weather()
    {
        $user_id = Auth::user()->id;
        $cities = City::where('user_id', $user_id)->get();
        $key = 'cecf15fe33faf9ec32e8e4dcbeec8e09';

        foreach ($cities as $city)
        {
            $city_id = $city['city_id'];
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather?id='.$city_id.'&appid='.$key);
            $temp = $response['main']['temp'];
            $humidity = $response['main']['humidity'];
            $name = $response['name'];
            
            $cart = ['selected_city_id' => $city['id'], 'name' => $name, 'temp' => $temp, 'humidity' => $humidity];
            $weather = Weather::create($cart);
        }
        
    }
}
