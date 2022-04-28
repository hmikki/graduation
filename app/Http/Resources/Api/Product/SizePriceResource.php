<?php

namespace App\Http\Resources\Api\Product;

use App\Helpers\Constant;
use App\Http\Resources\Api\Home\CountryResource;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SizePriceResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['product_id'] = $this->product_id;
        $Objects['size'] = $this->size;
        $country_coin = ( auth()->user() ? User::find(auth()->user()->getId())->country->coin : '');
        $price = $this->getPrice() * ( $country_coin ? $country_coin->price : 1);
        $Objects['price'] = $price;
        $Objects['active'] = $this->active;
        return $Objects;
    }
}
