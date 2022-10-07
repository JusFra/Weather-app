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
        info('save');
        return Command::SUCCESS;
    }
}
