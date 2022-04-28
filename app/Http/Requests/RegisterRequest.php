<?php

namespace App\Http\Requests;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use function redirect;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'student_id' => 'required|numeric|unique:users,student_id',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ];
    }
    public function persist(){
        $user = new User();
        $user->setEmail($this->email);
        $user->setStudentId($this->student_id);
        $user->setPassword($this->password);
        $user->save();
        if ($this->filled('device_token') && $this->filled('device_type')) {
            $user->setDeviceToken($this->device_token);
            $user->setDeviceType($this->device_type);
        }
        $user->save();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        $user->refresh();
        try {
            Functions::SendVerification($user, Constant::VERIFICATION_TYPE['Email']);
        }catch (\Exception $e) {
        }
        $user->refresh();
        if ($user) {
            return redirect()->route('application')->with(['success'=>__('messages.account_created_successfully')]);
        }else{
            return redirect()->route('application')->with(['error'=>__('messages.wrong_data')]);
        }
    }
}
