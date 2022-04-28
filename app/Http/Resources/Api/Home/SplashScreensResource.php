<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class SplashScreensResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['title'] = (app()->getLocale() == 'ar')?$this->getTitleAr():$this->getTitle();
        $Objects['description'] = (app()->getLocale() == 'ar')?$this->getDescriptionAr():$this->getDescription();
        $Objects['image'] = asset($this->getImage());
        return $Objects;
    }
}
