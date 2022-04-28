<?php

namespace App\Http\Requests\Api\Points;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;
use App\Http\Resources\Api\User\UserResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            //'ref_id' => 'required|exists:users,ref_id',
        ];
    }

    public function run(): JsonResponse
    {
        if (auth('api')->check()) {
            $logged = Auth::user();
            //$affiltiate_code = User::where('active', true)->pluck('affiltiate_code');
            $ref_affiltiate_code= User::where('id', Auth::id())->pluck('ref_affiltiate_code');
            $user_id = User::where('active', true)->where('affiltiate_code', $ref_affiltiate_code)->pluck('id');
            $Object = User::where('id', $user_id)->first();
            $points = ((User::where('id', $user_id)->pluck('points'))->first());
            $update_points = User::where('id', $user_id)->update(['points'=> ($points+100)]);
            $points = (User::where('id', $user_id)->pluck('points'));

            return $this->successJsonResponse([__('messages.updated_successful')],
            ['user'=>[
                'points'=> $points,
            ]
            ]
            );
        }
    }
}
