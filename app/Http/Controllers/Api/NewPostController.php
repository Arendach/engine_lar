<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NewPost\SearchCitiesRequest;
use App\Http\Requests\Api\NewPost\SearchWarehousesRequest;
use App\Http\Resources\NewPostCityResource;
use App\Http\Resources\NewPostWarehouseResource;
use App\Repositories\NewPostRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewPostController extends Controller
{
    private $newPostRepository;

    public function __construct()
    {
        $this->newPostRepository = app(NewPostRepository::class);
    }

    public function searchCities(SearchCitiesRequest $request): AnonymousResourceCollection
    {
        $cities = $this->newPostRepository->searchCities($request->get('name'));

        return NewPostCityResource::collection($cities);
    }

    public function searchWarehouses(SearchWarehousesRequest $request): AnonymousResourceCollection
    {
        $cities = $this->newPostRepository->searchWarehouses($request->get('city'));

        return NewPostWarehouseResource::collection($cities);
    }
}