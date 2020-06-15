<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NewPost\SearchCitiesRequest;
use App\Http\Resources\NewPostCityResource;
use App\Repositories\NewPostRepository;

class NewPostController extends Controller
{
    private $newPostRepository;

    public function __construct()
    {
        $this->newPostRepository = app(NewPostRepository::class);
    }

    public function searchCities(SearchCitiesRequest $request)
    {
        $cities = $this->newPostRepository->searchCities($request->get('name'));

        return NewPostCityResource::collection($cities);
    }
}