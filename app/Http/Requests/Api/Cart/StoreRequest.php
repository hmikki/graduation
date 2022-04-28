<?php

namespace App\Http\Requests\Api\Cart;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\CartResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'product_id'=>'required|exists:products,id',
            'quantity' => 'required',
            'size' => 'required',
        ];
    }

    public function run(): JsonResponse
    {
        $Product = (new Product())->find($this->product_id);
        /*$cart_items = (Cart::where('user_id', auth()->user()->getId())->where('product_id', $this->product_id))? Cart::where('user_id', auth()->user()->getId())->where('product_id', $this->product_id)->first(): "";
        if ($cart_items){
            $Cart = $cart_items;
            $quantity = $cart_items->getQuantity() + $this->quantity;
            $Cart->setQuantity($quantity);
            $Cart->save();
        }else{*/
            $Cart =new  Cart();
            $logged = auth()->user();
            $Cart->setUserId($logged->getId());
            $Cart->setProductId($this->product_id);
            $Cart->setSize($this->size);
            $Cart->setQuantity($this->quantity);
            $Cart->save();
        //}


        return $this->successJsonResponse([__('messages.saved_successfully')],new CartResource($Cart),'Cart');
    }
}
