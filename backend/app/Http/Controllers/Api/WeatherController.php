<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeatherRequest;
use App\Repositories\WeatherRepository;
use Illuminate\Http\Response;

class WeatherController extends Controller
{
    private $repository;

    public function __construct(WeatherRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(WeatherRequest $request)
    {
        $data = $request->validated();

        $query = $data['q'] ?? '';
        $limit = $data['limit'] ?? 5;
        $lat = $data['lat'] ?? null;
        $long = $data['long'] ?? null;
        return $this->repository->fetchForecast($query, $limit, $lat, $long);
    }
}
