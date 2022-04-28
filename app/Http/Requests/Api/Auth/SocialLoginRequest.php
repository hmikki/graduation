<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use http\Env\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;


class SocialLoginRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'device_token' => 'string|required_with:device_type',
            'device_type' => 'string|required_with:device_token',
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist(): JsonResponse
    {
        $user = $this->user();
        $request = Request::class;

        $provider = "facebook"; // or $request->input('provider_name') for multiple providers
        //$token = $this->device_token;
        $token = $request->access_token;
        // get the provider's user. (In the provider server)
        $providerUser = Socialite::driver($provider)->userFromToken($token);
        // check if access token exists etc..
        // search for a user in our server with the specified provider id and provider name
        $user = User::where('provider_name', $provider)->where('provider_id', $providerUser->id)->first();
        // if there is no record with these data, create a new user
        if($user == null){
            $user = User::create([
                'provider_name' => $provider,
                'provider_id' => $providerUser->id,
            ]);
        }
        // create a token for the user, so they can login
        //$token = $user->createToken(env('APP_NAME'))->token;
        DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        if ($this->filled('device_token')) {
            $user->setDeviceToken($this->device_token);
            $user->setDeviceType($this->device_type);
            $user->save();
        }
        // return the token for usage
        return $this->successJsonResponse( [__('auth.login')], new UserResource($user,$tokenResult->accessToken),'User');
       /* $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return $this->failJsonResponse([__('auth.failed')]);
        $user = $this->user();
        if (!$user->active)
            return $this->failJsonResponse([__('auth.blocked')]);

        DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        if ($this->filled('device_token')) {
            $user->setDeviceToken($this->device_token);
            $user->setDeviceType($this->device_type);
            $user->save();
        }
        return $this->successJsonResponse( [__('auth.login')], new UserResource($user,$tokenResult->accessToken),'User');*/
    }
}
