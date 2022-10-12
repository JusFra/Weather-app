<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cities = City::all();
        $key = config('weather.api_key');
        $url = config('weather.api_url');

        foreach ($cities as $city)
        {
            $city_id = $city['city_id'];
            $response = Http::get($url.$city_id.'&appid='.$key.'&units=metric');
            $temp = $response['main']['temp'];
            $humidity = $response['main']['humidity'];
            $icon = $response['weather'][0]['icon'];
            $name = $response['name'];
            
            $cart = ['selected_city_id' => $city['id'], 'name' => $name, 'temp' => $temp, 'humidity' => $humidity, 'icon' => $icon];
            $weather = Weather::create($cart);
        }
        info('save');
        return Command::SUCCESS;
    }
}
