<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Auth\CheckResetCodeRequest;
use App\Http\Requests\Api\Auth\ForgetPasswordRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\LogoutRequest;
use App\Http\Requests\Api\Auth\PasswordRequest;
use App\Http\Requests\Api\Auth\RefreshRequest;
use App\Http\Requests\Api\Auth\RegistrationRequest;
use App\Http\Requests\Api\Auth\ResendVerifyRequest;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\ShowRequest;
use App\Http\Requests\Api\Auth\SocialLoginForm;
use App\Http\Requests\Api\Auth\SocialLoginRequest;
use App\Http\Requests\Api\Auth\UpdateRequest;
use App\Http\Requests\Api\Auth\UserPointsRequest;
use App\Http\Requests\Api\Auth\VerifyRequest;
use App\Http\Requests\Api\Auth\VisitorRequest;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request): JsonResponse
    {
        return $request->persist();
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $request->persist();
    }

    public function show(ShowRequest $request): JsonResponse
    {
        return $request->persist();
    }

    public function logout(LogoutRequest $request): JsonResponse
    {
        return $request->persist();
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        return $request->persist();
    }

    public function refresh(RefreshRequest $request): JsonResponse
    {
         return $request->persist();
    }

    public function change_password(PasswordRequest $request): JsonResponse
    {
        return $request->persist();
    }

    public function resend_verify(ResendVerifyRequest $request): JsonResponse
    {
        return $request->persist();
    }

    public function verify(VerifyRequest $request): JsonResponse
    {
         return $request->persist();
    }

    public function forget_password(ForgetPasswordRequest $request): JsonResponse
    {
        return $request->persist();
    }

    public function reset_password(ResetPasswordRequest $request): JsonResponse
    {
        return $request->persist();
    }
    public function visitor(VisitorRequest $request){
            return $request->persist();
    }
    public function points(UserPointsRequest $request){
        return $request->persist();
    }
    /* google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Facebook callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
        return redirect()->route('login');
    }

    // Facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
        return redirect()->route('login');
    }

    // instagram login
    public function redirectToInstagram()
    {
        return Socialite::driver('instagram')->redirect();
    }

    // Facebook callback
    public function handleInstagramCallback()
    {
        $user = Socialite::driver('instagram')->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
        return redirect()->route('login');
    }

    // twitter login
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    // Facebook callback
    public function handleTwitterCallback()
    {
        $user = Socialite::driver('twitter')->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
        return redirect()->route('login');
    }
    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->save();
        }

        Auth::login($user);
    }
    */
    /**
     * Login user and create token
     *
     * @param SocialLoginForm $request
     * @return JsonResponse
     */
    public function social_login(SocialLoginForm $request)
    {
        return $request->persist();
    }
    public function check_reset_code(CheckResetCodeRequest $request): JsonResponse
    {
        return $request->run();
    }
}
