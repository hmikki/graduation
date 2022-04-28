<?php

namespace App\Http\Requests\Api\Order;

use App\Http\Requests\Api\ApiRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class DeleteRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'order_id' => 'required|exists:orders,id'
        ];
    }

    public function run(): JsonResponse
    {
        $Order =(new Order())->find($this->order_id);
        $Order->delete();
        return $this->successJsonResponse([__('messages.deleted_successfully')]);
    }
}
