<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
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
            'name' => 'string|max:255,',
            'email' => 'email|min:6|unique:users,id,'. auth()->user()->id,
            'mobile' => 'numeric|min:6|unique:users,id,'. auth()->user()->id,
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'image' => 'mimes:jpeg,jpg,bmp,png,',
            'address'=>'string|max:255',
            /*'lat'=>'string|max:255',
            'lng'=>'string|max:255',*/
            'device_token' => 'string|required_with:device',
            'device_type' => 'string|required_with:device_token',
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        $logged = auth()->user();
        if ($this->filled('name')) {
            $logged->setName($this->name);
        }
        if ($this->filled('email')) {
            $logged->setEmail($this->email);
        }
        if ($this->filled('mobile')) {
            $logged->setMobile($this->mobile);
        }
        if ($this->filled('country_id')) {
            $logged->setCountryId($this->country_id);
        }
        if ($this->filled('city_id')) {
            $logged->setCityId($this->city_id);
        }
        if ($this->filled('address')) {
            $logged->setAddress($this->address);
        }
        /*if ($this->filled('lat')) {
            $logged->setLat($this->lat);
        }
        if ($this->filled('lng')) {
            $logged->setLng($this->lng);
        }*/
        if ($this->filled('device_token') && $this->filled('device_type')) {
            $logged->setDeviceToken($this->device_token);
            $logged->setDeviceType($this->device_type);
        }
        if ($this->hasFile('image')) {
            $logged->setImage($this->file('image'));
        }
        $logged->save();
        return $this->successJsonResponse( [__('messages.updated_successful')], new UserResource($logged,$this->bearerToken()),'User');
    }
}
