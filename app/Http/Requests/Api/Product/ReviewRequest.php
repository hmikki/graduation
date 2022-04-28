<?php

namespace App\Http\Requests\Api\Product;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Food\FoodResource;
use App\Http\Resources\Api\Product\ProductResource;
use App\Http\Resources\Api\Product\ReviewResource;
use App\Models\Food;
use App\Models\Media;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed product_id
 * @property mixed rate
 * @property mixed review
 */
class ReviewRequest extends ApiRequest
{
    use ResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'order_id'=> 'required|exists:orders,id',
            'items'=>'required|array',
            'items.*.product_id'=>'required|exists:products,id',
            'items.*.rate'=>'required',
            'items.*.review'=>'string'
        ];
    }

    public function persist(): JsonResponse
    {
        $Order = (new Order())->find($this->order_id);
        $Object[] = '';
        foreach ($this->items as $key=>$block){
            $Product = (new Product)->find($block['product_id']);
            $Object[$key] = new Review();
            $Object[$key]->setUserId(auth()->user()->getId());
            $Object[$key]->setProductId($Product->getId());
            $Object[$key]->setOrderId($Order->getId());
            $Object[$key]->setRate($block['rate']);
            if (!empty($block['review'])) {
                $Object[$key]->setReview($block['review']);
            }
            $Object[$key]->save();
            $Product->refresh();
        }
        return $this->successJsonResponse([__('messages.updated_successful')], ReviewResource::collection($Object), 'Review');
    }
}
