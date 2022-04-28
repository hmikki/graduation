<?php

namespace App\Http\Resources\Api\Product;

use App\Helpers\Constant;
use App\Http\Resources\Api\Home\CountryResource;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AttributeResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->name_ar:$this->name;
        $Objects['description'] = (app()->getLocale() == 'ar')?$this->description_ar:$this->description;
        $Objects['active'] = $this->active;
        return $Objects;
    }
}
