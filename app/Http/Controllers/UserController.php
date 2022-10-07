<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\City2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            return redirect(route('dashboard'));
        }
    }

    public function my_cities()
    {
        $user_id = Auth::user()->id;
        
        return view('main_page', [
            'cities' => City::where('user_id', $user_id)->get(),
            'name_of_cities' => City2::all()
        ]);
    }
}
