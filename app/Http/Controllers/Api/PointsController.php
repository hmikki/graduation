<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Points\ShowRequest;
use App\Http\Requests\Api\Points\StoreRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class PointsController extends Controller
{
    use ResponseTrait;

    public function show(ShowRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function update(): JsonResponse
    {}

}
