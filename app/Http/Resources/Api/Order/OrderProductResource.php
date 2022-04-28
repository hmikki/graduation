<?php

namespace App\Http\Resources\Api\Order;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['order_id'] = $this->order_id;
        $Objects['product_id'] = $this->product_id;
        $Objects['quantity'] = $this->quantity;
        $Objects['name'] = $this->name;
        $Objects['address'] = $this->address;
        $Objects['description'] = $this->description;
        $Objects['quality'] = $this->quality;
        $Objects['price'] = $this->price;
        $Objects['size'] = $this->size;
        $Objects['image'] = asset($this->image);
        return $Objects;
    }
}
