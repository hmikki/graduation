<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\DeleteRequest;
use App\Http\Requests\Api\Order\IndexRequest;
use App\Http\Requests\Api\Order\ShowRequest;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Http\Requests\Api\Order\UpdateRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    use ResponseTrait;

    public function index(IndexRequest $request){
        return $request->run();
    }
    public function show(ShowRequest $request){
        return $request->run();
    }
    public function store(StoreRequest $request){
        return $request->run();
    }
    public function update(UpdateRequest $request){
        return $request->run();
    }
    public function delete(DeleteRequest $request){
        return$request->run();
    }

}
