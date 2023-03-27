<?php

namespace App\Repositories;

use App\Models\Weather;
use App\Services\OpenWeatherMapApiService;
use Illuminate\Http\JsonResponse;

class WeatherRepository
{
    /**
     * Fetches the weather forecast from OpenWeatherMap API
     */
    public function fetchForecast(string $query, int $limit = 5): JsonResponse
    {
        return app(OpenWeatherMapApiService::class)->getForecast($query, $limit);
    }

    /**
     * Converts a Celcius temperature to Fahrenheit value
     * @param float $celciusToFahrenheit
     * @return float
     */
    public function celciusToFahrenheit(float $celciusTemperature): float
    {
        return (float) (($celciusTemperature * 9/5) + 32);
    }

    /**
     * Converts a Fahrenheit temperature to Celcius value
     * @param float $fahrenheitTemperature
     * @return float
     */
    public function fahrenheitToCelcius(float $fahrenheitTemperature): float
    {
        $tempConversion = (float) ((($fahrenheitTemperature - 32) * 5) / 9);
        return round($tempConversion, 3);
    }

    /**
     * Converts Kelvin Temperature to Celcius
     * @return float
     */
    public function kelvinToCelcius(float $kelvinTemperature): float
    {
        return $kelvinTemperature - 273.15;
    }

    /**
     * Converts Kelvin Temperature to Fahrenheit
     * @return float
     */
    public function kelvinToFahrenheit(float $kelvinTemperature): float
    {
        $celcius = $this->kelvinToCelcius($kelvinTemperature);
        return $this->celciusToFahrenheit($celcius);
    }
}
