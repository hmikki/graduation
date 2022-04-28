<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\DeleteRequest;
use App\Http\Requests\Api\Cart\IndexRequest;
use App\Http\Requests\Api\Cart\StoreRequest;
use App\Http\Requests\Api\Cart\UpdateRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    use ResponseTrait;

    public function index(IndexRequest $request){
        return $request->run();
    }
    public function store(StoreRequest $request){
        return $request->run();
    }
    public function update(UpdateRequest $request){
        return$request->run();
    }
    public function delete(DeleteRequest $request){
        return$request->run();
    }

}
