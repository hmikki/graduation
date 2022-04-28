<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Notification\ReadAllRequest;
use App\Http\Requests\Api\Notification\ReadRequest;
use App\Http\Requests\Api\Notification\SearchRequest;
use App\Http\Requests\Api\Notification\SendRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    use ResponseTrait;
    public function index(SearchRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function read(ReadRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function read_all(ReadAllRequest $request): JsonResponse
    {
        return $request->run();
    }
    public function send(SendRequest $request): JsonResponse
    {
        return $request->run();
    }
}
