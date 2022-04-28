<?php

namespace App\Http\Requests\Api\Order;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Http\Resources\Api\Product\CartResource;
use App\Models\Order;
use App\Models\Product;
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
        $Objects =new  Order();
        if ($this->filled('is_completed') && $this->is_completed) {
            $Objects = $Objects->where('user_id',$logged->getId())->whereIn('status',Constant::COMPLETED_ORDER_STATUSES);
        }else{
            $Objects = $Objects->where('user_id',$logged->getId())->whereNotIn('status',Constant::COMPLETED_ORDER_STATUSES);
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = OrderResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Orders',$Objects);
    }
}
