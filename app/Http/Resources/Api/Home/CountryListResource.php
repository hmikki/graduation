<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryListResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->name_ar:$this->name;
        $Objects['flag'] = asset($this->getFlag());
        $Objects['country_code'] = $this->country_code;
        return $Objects;
    }
}
