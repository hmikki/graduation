<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Product\ProductResource;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class FavoriteRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function run(): JsonResponse
    {
        $product_ids = (new Favorite())->where('user_id',auth()->user()->getId())->pluck('product_id');
        $Objects = new Product();
        $Objects = $Objects->whereIn('id',$product_ids);
        if ($this->filled('brand_id')) {
            $Objects = $Objects->where('brand_id',$this->brand_id);
        }
        if ($this->filled('quality')) {
            $Objects = $Objects->where('quality',$this->quality);
        }
        if ($this->filled('q')) {
            $q = $this->q;
            $Objects = $Objects->where(function ($query) use ($q){
                return $query->where('name','Like','%'.$q.'%')
                    ->orWhere('name_ar','Like','%'.$q.'%')
                    ->orWhere('description','Like','%'.$q.'%')
                    ->orWhere('description_ar','Like','%'.$q.'%');
            });
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        return $this->successJsonResponse([],ProductResource::collection($Objects->items()),'Products',$Objects);
    }
}
