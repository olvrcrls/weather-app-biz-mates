<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Repositories\PlaceRepository;

class PlaceController extends Controller
{
    private $repository;

    public function __construct(PlaceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PlaceRequest $request)
    {
        return $this->repository->getNearPlaces($request->validated());
    }
}
