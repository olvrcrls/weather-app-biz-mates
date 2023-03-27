<?php

namespace App\Services;

use App\Base\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class FourSquareApiService extends BaseService
{
    /**
     *  Declaration of the API KEY for four square
     * @return string
     */
    public function apiKey(): string
    {
        return config('services.foursquare.key');
    }

    /**
     * Autocomplete search for places with provided query
     * @param string $query
     * @return JsonResponse
     */
    public function fetchNearPlaces(string $query, int $limit = 5): JsonResponse
    {
        $urlQuery = urlencode($query);
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey(),
        ])
        ->acceptJson()
        ->get(
            "https://api.foursquare.com/v3/places/search?near={$urlQuery}&limit={$limit}"
        );

        if ($response->failed()) {
            return Response::error('Something went wrong on the API call', $response->status());
        }

        $places = $response->json()['results'] ?? [];
        $geolocation = $response->json()['context']['geo_bounds']['circle']['center'] ?? [];
        $results = compact('geolocation', 'places');
        return Response::success($results);
    }
}
