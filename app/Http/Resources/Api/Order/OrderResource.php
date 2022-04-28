<?php

namespace App\Http\Resources\Api\Order;

use App\Http\Resources\Api\Product\ProductResource;
use App\Models\Discount;
use App\Models\Favorite;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['user_id'] = $this->user_id;
        $Objects['address_id'] = $this->address_id;
        $Objects['country_id'] = $this->country_id;
        $Objects['city_id'] = $this->city_id;
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->name_ar:$this->name;
        $Objects['address'] = $this->address;
        $Objects['lat'] = $this->lat;
        $Objects['lng'] = $this->lng;
        $Objects['mobile'] = $this->mobile;
        $Objects['status'] = $this->status;
        $Objects['order_status'] = OrderStatusResource::collection($this->order_status);
        $Objects['discount_id'] = $this->discount_id;
        $Objects['discount_amount'] = $this->discount_amount;
        $Objects['amount'] = $this->amount;
        $Objects['tax'] = $this->tax;
        $Objects['delivery'] = $this->delivery;
        $Objects['total'] = $this->total;
        $Objects['order_date'] = ($this->created_at)->format('y-m-d');
        $Objects['order_time'] = ($this->created_at)->format('h:m:s');
        $Objects['OrdersProducts'] =  OrderProductResource::collection($this->orders_products);
        $is_reviewed = (Review::where('order_id', $this->id)->first())? true: false;
        $Objects['is_review'] = $is_reviewed;
        return $Objects;
    }
}
