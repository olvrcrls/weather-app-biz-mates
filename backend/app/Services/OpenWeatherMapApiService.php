<?php

namespace App\Services;

use App\Base\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapApiService extends BaseService
{
    /**
     *  Declaration of the API KEY for four square
     * @return string
     */
    public function apiKey(): string
    {
        return config('services.open_weather_map.key');
    }

    /**
     * Fetches the type of unit of measure that will be the default
     * display.
     */
    public function unitMeasure(): string
    {
        return config('services.open_weather_map.default_temperature');
    }

    /**
     * Fetch forecast on the search string
     * @param string $search
     * @return JsonResponse
     */
    public function getForecast(string $search, int $limit = 5): JsonResponse
    {
        $query = urlencode($search);
        $response = Http::get(
            "api.openweathermap.org/data/2.5/forecast?q={$query}&cnt={$limit}&mode=json&units=" . $this->unitMeasure() . "&appid=" . $this->apiKey()
        );

        if ($response->failed()) {
            return Response::error("Something went wrong with the API call.", $response->status());
        }

        $results = $response->json();
        $data = [
            'weathers' => $this->formatWeatherForecast($results['list']),
            'city' => $results['city'] ?? [],
        ];

        return Response::success($data);
    }

    /**
     * Format to a more intuitive data format
     * @param array $data
     * @return array
     */
    private function formatWeatherForecast(array $data): array
    {
        $output = [];

        if (!empty($data)) {
            foreach ($data as $i => $forecast) {
                $output[$i] = [
                    'date' => Arr::get($forecast, 'dt_txt', '0000-00-00'),
                    'icon' => Arr::get($forecast, 'weather.0.icon', ''),
                    'weather' => Arr::get($forecast, 'weather.0.main', 'N/A'),
                    'description' => Arr::get($forecast, 'weather.0.description', 'N/A'),
                    'wind' => Arr::get($forecast, 'wind', 'N/A'),
                    'temperature' => Arr::get($forecast, 'main.temp', 'N/A'),
                    'feels_like' => Arr::get($forecast, 'main.feels_like', 'N/A'),
                    'humidity' => Arr::get($forecast, 'main.humidity', 0),
                    'temp_min' => Arr::get($forecast, 'main.temp_min', 0),
                    'temp_max' => Arr::get($forecast, 'main.temp_max', 0),
                    'sea_level' => Arr::get($forecast, 'main.sea_level', 0),
                    'ground_level' => Arr::get($forecast, 'main.ground_level', 0),
                    'visibility' => Arr::get($forecast, 'visibility', 0),
                ];
            }
        }

        return $output;
    }
}
