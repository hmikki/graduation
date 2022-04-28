<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\JsonResponse;

class RefreshRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'device_type' => 'required|string',
            'device_token' => 'required|string'
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        $logged = auth()->user();
        $logged->setDeviceToken($this->device_token);
        $logged->setDeviceType($this->device_type);
        $logged->save();
        return $this->successJsonResponse( [__('auth.login')], new UserResource($logged,$this->bearerToken()),'User');

    }
}
