<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'order_id'=>'required|exists:orders,id'
        ];
    }

    public function run(): JsonResponse
    {
        $Object = (new Order())->find($this->order_id);
        return $this->successJsonResponse([],new OrderResource($Object),'Order');
    }
}
