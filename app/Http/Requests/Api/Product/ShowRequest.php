<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\CartResource;
use App\Http\Resources\Api\Product\ProductResource;
use App\Models\Product;
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
            'product_id'=>'required|exists:products,id'
        ];
    }

    public function run(): JsonResponse
    {
        $Object = (new Product())->find($this->product_id);
        return $this->successJsonResponse([],new ProductResource($Object),'Product');
    }
}
