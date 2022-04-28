<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Product\ProductResource;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ToggleFavoriteRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules():array
    {
        return [
            'product_id'=>'required|exists:products,id',
        ];
    }
    public function persist(): JsonResponse
    {
        $Product = (new Product())->find($this->product_id);
        $logged = auth()->user();
        $Object = (new Favorite())->where('product_id',$Product->getId())->where('user_id',$logged->getId())->first();
        if (!$Object){
            $Object = new Favorite();
            $Object->setProductId($Product->getId());
            $Object->setUserId($logged->getId());
            $Object->save();
        }else{
            $Object->delete();
        }
        return $this->successJsonResponse([__('messages.updated_successful')],new ProductResource($Product),'Product');
    }
}
