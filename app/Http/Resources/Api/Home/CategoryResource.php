<?php

namespace App\Http\Resources\Api\Home;

use App\Helpers\Functions;
use App\Models\Brand;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->name_ar:$this->name;
        $Objects['brand_id'] = $this->getBrandId();
        $Objects['brand'] = BrandResource::collection(Brand::find($this->brand));
        return $Objects;
    }
}
