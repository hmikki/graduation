<?php

namespace App\Http\Resources\Api\Order;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderStatusResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['order_id'] = $this->order_id;
        $Objects['status'] = $this->status;
        $Objects['order_status_date'] = ($this->created_at)->format('y-m-d');
        $Objects['order_status_time'] = ($this->created_at)->format('h:m:s');
        return $Objects;
    }
}
