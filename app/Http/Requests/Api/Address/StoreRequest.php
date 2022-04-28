<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Address\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'country_id'=>'required|exists:countries,id',
            'city_id'=>'required|exists:cities,id',
            'name'=>'required|string|max:255',
            'address'=>'required|string|max:255',
            'lat'=>'required|string|max:255',
            'lng'=>'required|string|max:255',
            'mobile'=>'required|string|max:255',
        ];
    }
    public function run(): JsonResponse
    {
        $Address =new Address();
        $Address->setUserId(auth()->user()->getId());
        $Address->setCountryId($this->country_id);
        $Address->setCityId($this->city_id);
        $Address->setName($this->name);
        $Address->setAddress($this->address);
        $Address->setLat($this->lat);
        $Address->setLng($this->lng);
        $Address->setMobile($this->mobile);
        $Address->save();
        return $this->successJsonResponse([__('messages.saved_successfully')],new AddressResource($Address),'Address');
    }
}
