<?php

namespace App\Models;

use App\Repositories\WeatherRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Returns the user that saved the weather condition
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCelciusAttribute()
    {
        if (!$this->temperature) {
            return 0;
        }

        return app(WeatherRepository::class)->kelvinToCelcius($this->temperature);
    }

    public function getFahrenheitAttribute()
    {
        if (!$this->temperature) {
            return 0;
        }

        return app(WeatherRepository::class)->kelvinToFahrenheit($this->temperature);
    }
}
