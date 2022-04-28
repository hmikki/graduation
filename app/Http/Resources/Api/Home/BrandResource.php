<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->name_ar:$this->name;
        $Objects['image'] = asset($this->getImage());
        return $Objects;
    }
}
