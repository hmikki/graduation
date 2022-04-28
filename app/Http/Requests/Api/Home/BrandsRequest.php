<?php

namespace App\Http\Requests\Api\Home;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\AdvertisementResource;
use App\Http\Resources\Api\Home\BrandResource;
use App\Http\Resources\Api\Product\CartResource;
use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\JsonResponse;


class BrandsRequest extends ApiRequest
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
        $Brands = BrandResource::collection(Brand::where('active',true)->get());
        return $this->successJsonResponse([],[
            'Brands'=>$Brands,
            ]);
    }
}
