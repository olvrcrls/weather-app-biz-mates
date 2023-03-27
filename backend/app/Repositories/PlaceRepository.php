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
    public function getNearPlaces(array $data): JsonResponse
    {
        $query = $data['q'];
        $limit = $data['limit'];

        return app(FourSquareApiService::class)->fetchNearPlaces($query, $limit);
    }
}
