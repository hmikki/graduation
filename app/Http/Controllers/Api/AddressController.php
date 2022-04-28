<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Address\DestroyRequest;
use App\Http\Requests\Api\Address\IndexRequest;
use App\Http\Requests\Api\Address\ShowRequest;
use App\Http\Requests\Api\Address\StoreRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    use ResponseTrait;

    public function index(IndexRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function show(ShowRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function store(StoreRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function delete(DestroyRequest $request): JsonResponse
    {
        return $request->run();
    }
}
