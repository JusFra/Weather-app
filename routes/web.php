<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeatherController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("/add_city", [UserController::class, 'search'])->middleware(['auth'])->name('add_city');
Route::post("/cities/getCities/", [UserController::class, 'getCities'])->middleware(['auth'])->name("cities.getCities");
Route::post('/add_city', [UserController::class, 'store'])->middleware(['auth'])->name('city.store');

Route::get('/main_page', [UserController::class, 'my_cities'])->middleware(['auth'])->name('main_page');

require __DIR__.'/auth.php';


//Route::get('city', [CityController::class, 'index']);

Route::get("/add_city", [UserController::class, 'search'])->middleware(['auth'])->name('add_city');
Route::post("/cities/getCities/", [UserController::class, 'getCities'])->middleware(['auth'])->name("cities.getCities");

Route::get("/save_weather", [WeatherController::class, 'save_weather'])->middleware(['auth'])->name('save_weather');