<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Street\SearchRequest;
use App\Http\Resources\StreetResource;
use App\Models\Street;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StreetController extends Controller
{
    public function search(SearchRequest $request): AnonymousResourceCollection
    {
        $streets = Street::where('name', 'like', "%{$request->name}%")
            ->orderBy('name')
            ->limit(100)
            ->get();

        return StreetResource::collection($streets);
    }
}