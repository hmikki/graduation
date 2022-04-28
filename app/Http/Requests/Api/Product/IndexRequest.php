<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Product\CartResource;
use App\Http\Resources\Api\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function run(): JsonResponse
    {
        $Objects = new Product();
        if ($this->filled('brand_id')) {
            $Objects = $Objects->where('brand_id',$this->brand_id);
        }
        if ($this->filled('quality')) {
            $Objects = $Objects->where('quality',$this->quality);
        }
        if ($this->filled('country_id')) {
            $Objects = $Objects->where('country_id',$this->country_id);
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
        return $this->successJsonResponse([],[
            'Products' => ProductResource::collection($Objects->items()),
//            'more_sales'=>ProductResource::collection(Product::where('active', true)->inRandomOrder()->limit(5)->get()),
            'more_sales'=>ProductResource::collection($Objects->shuffle()->take(5))
        ], 'Product', $Objects);
    }
}
