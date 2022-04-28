<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Dashboard\Controller;
use App\Models\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        parent::__construct();
    }

    public function username()
    {
        return 'email';
    }


    protected function guard()
    {
        return Auth::guard('dashboard');
    }
    public function showLoginForm()
    {
        return view('AhmedPanel.auth.login');
    }
    public function authenticated(Request $request, $user){
        Log::CreateLog(Log::$Type['Login'],$user->id,$request->ip(),$user->id);
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function logout(Request $request)
    {
        Log::CreateLog(Log::$Type['Logout'],auth('dashboard')->user()->id,$request->ip(),auth('dashboard')->user()->id);
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('dashboard');
    }

}
