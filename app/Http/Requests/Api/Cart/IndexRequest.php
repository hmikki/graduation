<?php

namespace App\Http\Requests\Api\Cart;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function run(): JsonResponse
    {
        $logged = auth()->user();
        $Objects =new  Cart();
        $Objects = $Objects->where('user_id',$logged->getId())->where('active', true);

        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = CartResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Cart',$Objects);
    }
}
