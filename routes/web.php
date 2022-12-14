<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'my_cities'])->middleware(['auth'])->name('dashboard');

Route::get("/add_city", [UserController::class, 'search'])->middleware(['auth'])->name('add_city');
Route::post("/add_city", [UserController::class, 'store'])->middleware(['auth'])->name('store');

Route::post("/cities/getCities/", [UserController::class, 'getCities'])->middleware(['auth'])->name("cities.getCities");

require __DIR__.'/auth.php';


//Route::get('city', [CityController::class, 'index']);

Route::get("/weather_plot/{id}", [UserController::class, 'plot'])->middleware(['auth'])->name('weather_plot');

Route::delete("/dashboard/{id}", [UserController::class, 'destroy'])->middleware(['auth'])->name('city_destroy');