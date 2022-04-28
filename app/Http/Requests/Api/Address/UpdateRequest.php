<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Address\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'address_id'=>'required|exists:addresses,id',
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
        $Address =(new Address())->find($this->address_id);
        if ($this->filled('country_id')) {
            $Address->setCountryId($this->country_id);
        }
        if ($this->filled('city_id')) {
            $Address->setCityId($this->city_id);
        }
        if ($this->filled('name')) {
            $Address->setName($this->name);
        }
        if ($this->filled('address')) {
            $Address->setAddress($this->address);
        }
        if ($this->filled('lat')) {
            $Address->setLat($this->lat);
        }
        if ($this->filled('lng')) {
            $Address->setLng($this->lng);
        }
        if ($this->filled('mobile')) {
            $Address->setMobile($this->mobile);
        }
        $Address->save();
        return $this->successJsonResponse([__('messages.saved_successfully')],new AddressResource($Address),'Address');
    }
}
