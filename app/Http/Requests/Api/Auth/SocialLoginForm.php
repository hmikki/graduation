<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Master;
use App\Models\SocialLogin;
use App\Traits\ResponseTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class SocialLoginForm extends ApiRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'provider' => 'required|in:google,facebook',
            'token' => 'required|string',
            //'type' => 'required|in:'.User::TYPE['Customer'].','.User::TYPE['Provider'],
            'device_token' => 'string|required_with:device',
            'device_type' => 'string|required_with:device_token',
        ];
    }
    public function attributes()
    {
        return Master::NiceNames('User');
    }
    public function persist() : JsonResponse
    {
        $Login = Master::SocialLogin($this->provider,$this->token);
        if($Login == null)
            return $this->failJsonResponse([__('auth.failed')]);
        $SocialLogin = SocialLogin::where('provider',$this->provider)->where('provider_id',$Login['provider_id'])->first();

        if($SocialLogin == null){
            $ExistEmail = User::where('email',$Login['email'])->first();
            $user = new User();
            $user->name = $Login['name'];
            if($ExistEmail == null && $Login['email'] != null){
                $user->email = $Login['email'];
            }else{
                $user->email = $Login['provider_id'].'@'.$this->provider.'.com';
            }
            $user->type = $this->type;
            $user->save();
            $user = User::find($user->id);
            SocialLogin::create(['provider'=>$this->provider,'provider_id'=>$Login['provider_id'],'user_id'=>$user->id]);
        }else{
            $user = $SocialLogin->user;
            if($user->type != $this->type){
                return $this->failJsonResponse([__('auth.failed')]);
            }
        }
        DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        if ($this->input('device_token')) {
            $user->device_token = $this->device_token;
            $user->device_type = $this->device_type;
            $user->save();
        }
        $user['access_token']= $tokenResult->accessToken;
        $user['token_type']= 'Bearer';
        return $this->successJsonResponse( [__('auth.login')], $user,'User');
    }
}
