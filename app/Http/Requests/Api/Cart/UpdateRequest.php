<?php

namespace App\Http\Requests\Api\Cart;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed product_id
 * @property mixed quantity
 */
class UpdateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cart_id' => 'required|exists:cart,id',
            //'product_id'=>'required|exists:products,id',
            'quantity' => 'required',
        ];
    }

    public function run(): JsonResponse
    {
        $Cart = (new  Cart())->find($this->cart_id);
       /* if ($this->filled('product_id')) {
            $Cart->setProductId($this->product_id);
        }*/
        if ($this->filled('quantity')) {
            $Cart->setQuantity($this->quantity);
        }
        $Cart->save();
        return $this->successJsonResponse([__('messages.saved_successfully')],new CartResource($Cart),'Cart');
    }
}
