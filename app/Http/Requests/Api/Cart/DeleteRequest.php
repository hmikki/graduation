<?php

namespace App\Http\Requests\Api\Cart;

use App\Http\Requests\Api\ApiRequest;
use App\Models\Cart;
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
            'cart_id' => 'required|exists:cart,id'
        ];
    }

    public function run(): JsonResponse
    {
        $Cart =(new Cart())->find($this->cart_id);
        $Cart->delete();
        return $this->successJsonResponse([__('messages.deleted_successfully')]);
    }
}
