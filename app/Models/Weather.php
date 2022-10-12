<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Weather extends Model
{
    use HasFactory;

    protected $fillable = [
        'selected_city_id',
        'name',
        'temp',
        'humidity',
        'icon'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
}
