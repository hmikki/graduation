<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use function __;
use function redirect;
use function request;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
    public function persist(){
        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)){
            return redirect()->route('application')->with(['success'=>__('messages.login_successful')]);
        }else{
            return redirect()->back()->with(['error'=>__('messages.failed')]);
        }
    }
}
