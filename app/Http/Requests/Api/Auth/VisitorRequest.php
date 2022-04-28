<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\JsonResponse;


class VisitorRequest extends ApiRequest
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
        $Advertisements = AdvertisementResource::collection(Advertisement::where('active',true)->get());
        return $this->successJsonResponse([],['Advertisements'=>$Advertisements]);
    }
}
