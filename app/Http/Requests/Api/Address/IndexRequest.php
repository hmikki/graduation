<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Address\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function run(): JsonResponse
    {
        $logged = auth()->user();
        $Objects = new Address();
        $Objects = $Objects->where('user_id',$logged->getId());
        if ($this->filled('country_id')) {
            $Objects = $Objects->where('country_id',$this->country_id);
        }
        if ($this->filled('city_id')) {
            $Objects = $Objects->where('city_id',$this->city_id);
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        return $this->successJsonResponse([],AddressResource::collection($Objects->items()),'Addresses',$Objects);
    }
}
