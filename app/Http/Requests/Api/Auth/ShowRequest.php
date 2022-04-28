<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        $user = auth()->user();
//        if (is_null($user->mobile_verified_at))
//            return $this->failJsonResponse([__('auth.unactivated')],205);
        if (!$user->active)
            return $this->failJsonResponse([__('auth.blocked')]);
        $user->save();
        return $this->successJsonResponse([],new UserResource($user,$this->bearerToken()),'User');
    }
}
