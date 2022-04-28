<?php

namespace App\Http\Resources\Api\User;

use App\Http\Resources\Api\Home\CountryListResource;
use App\Http\Resources\Api\Home\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $token;
    public function __construct($resource, $token =null)
    {
        $this->token = $token;
        parent::__construct($resource);
    }
    public function toArray($request): array
    {
        $Object['id'] = $this->getId();
        $Object['name'] = $this->getName();
        $Object['email'] = $this->getEmail();
        $Object['mobile'] = $this->getMobile();
        $Object['country_id'] = $this->getCountryId();
        $Object['Country'] = new CountryListResource($this->country);
        $Object['city_id'] = $this->getCityId();
        $Object['City'] = new CityResource($this->city);
        $Object['image'] = $this->getImage();
        $Object['address'] = $this->getAddress();
        $Object['lat'] = $this->getLat();
        $Object['lng'] = $this->getLng();
        $Object['points'] = $this->getPoint();
        $Object['email_verified'] = (bool)$this->email_verified_at;
        $Object['mobile_verified'] = (bool)$this->mobile_verified_at;
        $Object['affiltiate_code'] = $this->affiltiate_code;
        $Object['ref_affiltiate_code'] = $this->ref_affiltiate_code;
        $Object['notification_count'] = $this->notifications()->where('read_at',null)->count();
        $Object['access_token'] = $this->token;
        $Object['token_type'] = 'Bearer';
        return $Object;
    }

}
