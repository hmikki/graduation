<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ResetPasswordRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required_without:mobile|email|exists:users,email',
            'mobile' => 'required_without:email|email|exists:users,mobile',
            'code' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        if ($this->filled('email')) {
            $user = User::where('email',$this->email)->first();
        }
        if ($this->filled('mobile')) {
            $user = User::where('mobile',$this->mobile)->first();
        }
        $passwordReset = PasswordReset::where('user_id',$user->id)->first();
        if($passwordReset && $passwordReset->code == $this->code){
            $user->password = $this->password;
            $user->save();
            DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();
            return $this->successJsonResponse( [__('messages.updated_successful')], new UserResource($user,$tokenResult->accessToken),'User');
        }
        else{
            return $this->failJsonResponse( [__('auth.code_not_correct')]);
        }
    }
}
