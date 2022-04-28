<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\BrandResource;
use App\Http\Resources\Api\User\UserResource;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserPointsRequest extends ApiRequest
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
        if (auth('api')->check()) {
            $user = Auth::user();
            $points = User::where('id',auth()->user()->getId())->pluck('points');
            return $this->successJsonResponse([],[
                'User'=>[
                    'Points' => $points,
                    ]
            ]);
        }

        }
}
