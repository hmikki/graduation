<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use App\Models\VerifyAccounts;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class VerifyRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile'=>'required_if:type,'.Constant::VERIFICATION_TYPE['Mobile'].'|exists:users,mobile',
            'email'=>'required_if:type,'.Constant::VERIFICATION_TYPE['Email'].'|exists:users,email',
            'code' => 'required|string',
            'type' => 'required|in:'.Constant::VERIFICATION_TYPE_RULES,
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        if ($this->type == Constant::VERIFICATION_TYPE['Mobile']) {
            $logged = User::where('mobile',$this->mobile)->first();
        }
        if ($this->type == Constant::VERIFICATION_TYPE['Email']) {
            $logged = User::where('email',$this->email)->first();
        }
        $verify = VerifyAccounts::where('user_id',$logged->id)->where('type',$this->type)->first();
        if($this->code != $verify->code)
            return $this->failJsonResponse([__('auth.failed')]);
        if ($this->type == Constant::VERIFICATION_TYPE['Email']) {
            if($logged->email_verified_at != null)
                return $this->failJsonResponse([__('auth.verified_before')]);
            $logged->email_verified_at = now();
        }
        if ($this->type == Constant::VERIFICATION_TYPE['Mobile']) {
            if($logged->mobile_verified_at != null)
                return $this->failJsonResponse([__('auth.verified_before')]);
            $logged->mobile_verified_at = now();
        }
        $logged->save();
        DB::table('oauth_access_tokens')->where('user_id', $logged->id)->delete();
        $tokenResult = $logged->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return $this->successJsonResponse( [__('auth.login')], new UserResource($logged,$tokenResult->accessToken),'User');
    }
}
