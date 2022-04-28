<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class PasswordRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        $logged = auth()->user();
        if(Hash::check($this->old_password,$logged->password)){
            $logged->setPassword($this->password);
            $logged->save();
            return $this->successJsonResponse( [__('messages.updated_successful')], new UserResource($logged,$this->bearerToken()),'User');
        }
        return $this->failJsonResponse([__('auth.password_not_correct')]);
    }
}
