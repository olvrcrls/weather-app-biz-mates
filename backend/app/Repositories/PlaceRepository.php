<?php

namespace App\Repositories;

use App\Services\FourSquareApiService;
use Illuminate\Http\JsonResponse;

class PlaceRepository
{
    /**
     * Fetch the places near the search query
     * Ex. "Osaka JP" it will fetch places in Osaka, JP
     */
    public function getNearPlaces(string $query, int $limit): JsonResponse
    {
        return app(FourSquareApiService::class)->fetchNearPlaces($query, $limit);
    }
}
