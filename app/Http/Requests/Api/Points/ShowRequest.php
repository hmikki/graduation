<?php

namespace App\Http\Requests\Api\Points;

use App\Http\Requests\Api\ApiRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ShowRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [];
    }

    public function run(): JsonResponse
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
