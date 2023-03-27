<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeatherRequest;
use App\Repositories\WeatherRepository;

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
        return $this->repository->fetchForecast($request()->query, $request->limit);
    }
}
