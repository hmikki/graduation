<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Home\BrandsRequest;
use App\Http\Requests\Api\Home\HomeRequest;
use App\Http\Requests\Api\Home\InstallRequest;
use App\Http\Requests\Api\Home\WebHomeRequest;
use App\Http\Requests\Api\Product\FavoriteRequest;
use App\Http\Requests\Api\Product\IndexRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    use ResponseTrait;

    public function install(InstallRequest $request): JsonResponse
    {
        return $request->run();
    }

    public function index(HomeRequest $request): JsonResponse
    {
        return $request->persist();
    }

}
