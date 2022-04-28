<?php

namespace App\Http\Resources\Api\Home;

use App\Models\Coin;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->name_ar:$this->name;
        $Objects['coin_id'] = $this->getCoinId();
        $Objects['coin'] = Coin::find($this->getCoinId());
        $Objects['flag'] = asset($this->getFlag());
        $Objects['country_code'] = $this->country_code;
        $Objects['delivery_cost'] = $this->getDeliveryCost();
        $Objects['tax'] = $this->getTax();
        $Objects['Cities'] = CityResource::collection($this->cities);
        return $Objects;
    }
}
