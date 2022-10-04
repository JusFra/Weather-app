<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        return view('add_city');
    }

    public function store(Request $request)
    {
        $city = new City;
        $city->city_id = $request->city_id;
        $city->user_id = Auth::user()->id;
        $city->save();

        return redirect(route('add_city'));
    }
}
