<?php

namespace App\Http\Resources\Api\Address;

use App\Http\Controllers\Dashboard\AppData\CityController;
use App\Http\Resources\Api\Home\CityResource;
use App\Http\Resources\Api\Home\CountryResource;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['user_id'] = $this->getUserId();
        $Objects['country_id'] = $this->getCountryId();
        $Objects['Country'] = CountryResource::collection(Country::where('id',$this->getCountryId())->get());
        $Objects['city_id'] = $this->getCityId();
        $Objects['City'] = CityResource::collection(City::where('id',$this->getCityId())->get());
        $Objects['name'] = $this->getName();
        $Objects['address'] = $this->getAddress();
        $Objects['lat'] = $this->getLat();
        $Objects['lng'] = $this->getLng();
        $Objects['mobile'] = $this->getMobile();
        return $Objects;
    }
}
