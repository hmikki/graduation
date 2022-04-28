<?php

namespace App\Http\Resources\Api\Product;

use App\Helpers\Constant;
use App\Http\Resources\Api\Home\CountryResource;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ReviewResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['product_id'] = $this->product_id;
        $Objects['order_id'] = $this->order_id;
        $Objects['user_id'] = $this->user_id;
        $Objects['rate'] = $this->rate;
        $Objects['review'] = $this->review;
        return $Objects;
    }
}
