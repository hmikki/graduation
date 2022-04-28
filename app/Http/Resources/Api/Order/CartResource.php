<?php

namespace App\Http\Resources\Api\Order;

use App\Http\Resources\Api\Product\MediaResource;
use App\Http\Resources\Api\Product\ProductResource;
use App\Http\Resources\Api\Product\SizePriceResource;
use App\Models\Cart;
use App\Models\Media;
use App\Models\Product;
use App\Models\SizePrice;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['user_id'] = $this->user_id;
        $Objects['product_id'] = $this->product_id;
        $Objects['Product'] = Product::where('id', $this->product_id)->first();
        $Objects['Media'] = Media::where('ref_id', $this->product_id)->first();
        $Objects['size'] = $this->size;
        $Objects['size_price'] = SizePrice::where('product_id', $this->product_id)->where('size' , $this->size)->first();
        $Objects['Order_status'] =($this->order_status)? OrderStatusResource::collection($this->order_status): '';
        $Objects['tax'] = $this->user->country->getTax();
        $Objects['delivery'] = $this->user->country->getDeliveryCost();
        $Objects['quantity'] = $this->quantity;
        return $Objects;
    }
}
