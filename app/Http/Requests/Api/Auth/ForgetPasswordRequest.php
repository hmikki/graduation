<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ForgetPasswordRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile'=>'required_if:type,'.Constant::FORGET_TYPE['Mobile'].'|exists:users,mobile',
            'email'=>'required_if:type,'.Constant::FORGET_TYPE['Email'].'|exists:users,email',
            'type' => 'required|in:'.Constant::FORGET_TYPE_RULES,
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        if ($this->type == Constant::VERIFICATION_TYPE['Mobile']) {
            $user = User::where('mobile',$this->mobile)->first();
        }
        if ($this->type == Constant::VERIFICATION_TYPE['Email']) {
            $user = User::where('email',$this->email)->first();
        }
        if($user){
            Functions::SendForget($user,$this->type);
            return $this->successJsonResponse([__('auth.code_sent')] );
        }
        return $this->failJsonResponse([__('messages.object_not_found')]);
    }
}
