<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;

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
        // TODO: Request latitude and longitude to retrieved near places
        return $this->repository->getNearPlaces($request->query, $request->limit);
    }
}
