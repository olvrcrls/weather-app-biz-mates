<?php

namespace App\Repositories;

use App\Models\Weather;

class WeatherRepository
{
    /**
     * Model instance of the repository
     * @return Weather
     */
    public function model(): Weather
    {
        return new Weather();
    }

    /**
     * Saves the weather information
     * @param array $data
     * @return Weather $newWeather
     */
    public function save(array $data)
    {
        $newWeather = $this->model()->query()
            ->create($data);

        return $newWeather;        
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
