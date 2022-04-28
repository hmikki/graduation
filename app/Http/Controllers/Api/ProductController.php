<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Home\BrandsRequest;
use App\Http\Requests\Api\Product\IndexRequest;
use App\Http\Requests\Api\Product\ReviewRequest;
use App\Http\Requests\Api\Product\ShowRequest;
use App\Http\Requests\Api\Product\FavoriteRequest;
use App\Http\Requests\Api\Product\ToggleFavoriteRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    use ResponseTrait;

    public function index(IndexRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function toggle_favorite(ToggleFavoriteRequest $request): JsonResponse
    {
        return $request->persist();
    }

    public function show(ShowRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function favorites(FavoriteRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function brands(BrandsRequest $request){
        return $request->persist();
    }
    /**
     * @param ReviewRequest $request
     * @return JsonResponse
     */
    public function review(ReviewRequest $request): JsonResponse
    {
        return $request->persist();
    }
}
