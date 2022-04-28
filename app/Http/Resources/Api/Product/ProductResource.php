<?php

namespace App\Http\Resources\Api\Product;

use App\Helpers\Constant;
use App\Http\Resources\Api\Home\CountryResource;
use App\Models\Attribute;
use App\Models\Country;
use App\Models\Favorite;
use App\Models\Media;
use App\Models\Review;
use App\Models\SizePrice;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->id;
        $Objects['brand_id'] = $this->brand_id;
        $Objects['name'] = app()->getLocale() == 'ar'?$this->name_ar:$this->name;
        $Objects['description'] = app()->getLocale() == 'ar'?$this->description_ar:$this->description;
        $Objects['product_no'] = $this->product_no;
        $Objects['quality'] = $this->quality;
        if($Objects['quality'] == 2){
            $Objects['quality_name'] = "HIGH";
        }else if($Objects['quality'] == 1){
            $Objects['quality_name'] = "MID";
        }else if($Objects['quality'] == 0){
            $Objects['quality_name'] = "LOW";
        }
        $Objects['active'] = $this->active;
        $is_favorite = false;
        if (auth()->user()) {
            $is_favorite = (bool)Favorite::where('user_id',auth()->user()->getId())->where('product_id',$this->id)->first();
        }
        $Objects['is_favorite'] = $is_favorite;
        $has_rate = 0;
        $rates = Review::where('product_id', $this->id)->get();
        $Objects['review'] = count($rates);
        $avg = count($rates);
        if ($rates){
            foreach ($rates as $rate){
                $has_rate = ($has_rate + intval($rate->getRate()) / $avg);
            }
        }
        $Objects['rate'] = $has_rate;
        $Objects['country_id'] = $this->getCountryId();
        $Objects['country'] = CountryResource::collection(Country::find($this->country));
        /*$country_coin = ( auth()->user() ?   User::find(auth()->user()->getId())->country->coin : '');
        $price = $this->getPrice() * ( $country_coin ? $country_coin->price : 1);
        $Objects['price'] = $price;
        $Objects['size'] = $this->size;*/
        $Objects['Media'] = $this->media? MediaResource::collection($this->media): null;
        $Objects['size_price'] =  $this->size_price? SizePriceResource::collection($this->size_price):null;
        $Objects['attributes'] = $this->attributes? AttributeResource::collection($this->attributes):null;
        return $Objects;
    }
}
