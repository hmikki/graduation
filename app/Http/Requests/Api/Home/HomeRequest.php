<?php

namespace App\Http\Requests\Api\Home;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\AdvertisementResource;
use App\Http\Resources\Api\Home\BrandResource;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Http\Resources\Api\Home\OfferResource;
use App\Http\Resources\Api\Order\CartResource;
use App\Http\Resources\Api\Product\ProductResource;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;


class HomeRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        $Objects = new Product();

        if ($this->filled('country_id')) {
            $Objects = $Objects->where('country_id',$this->country_id);
        }
        $Advertisements = AdvertisementResource::collection(Advertisement::where('active',true)->get());
        $Brands = BrandResource::collection(Brand::where('active',true)->get());
        $products = ProductResource::collection($Objects->get());
        $Categories = CategoryResource::collection(Category::where('active', true)->get());
        $offers = OfferResource::collection(Offer::all());
        $more_sales =  ProductResource::collection($Objects->inRandomOrder()->limit(5)->get());
        return $this->successJsonResponse([],[
            'Advertisements'=>$Advertisements,
            'Brands'=>$Brands,
            'Products' => $products,
            'Categories'=> $Categories,
            'Offers' => $offers,
            'more_sales' => $more_sales
            ]);
    }
}
