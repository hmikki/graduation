<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ResendVerifyRequest extends ApiRequest
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
            'type'=>'required|in:'.Constant::VERIFICATION_TYPE_RULES
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        if ($this->type == Constant::VERIFICATION_TYPE['Mobile']) {
            $Object = User::where('mobile',$this->mobile)->first();
        }
        if ($this->type == Constant::VERIFICATION_TYPE['Email']) {
            $Object = User::where('email',$this->email)->first();
        }
        return Functions::SendVerification($Object,$this->type);
    }
}
