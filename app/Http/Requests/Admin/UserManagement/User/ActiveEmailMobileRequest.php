<?php

namespace App\Http\Requests\Admin\UserManagement\User;

use App\Mail\VerificationDoneMail;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;

class ActiveEmailMobileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function preset($crud,$id){
        $Object = $crud->getEntity()->find($id);
        if(!$Object)
            return $crud->wrongData();
        $Object->email_verified_at = Carbon::today();
        $Object->mobile_verified_at = Carbon::today();
        $Object->save();
        Mail::to([$Object->email])->send(new VerificationDoneMail());
        return redirect($crud->getRedirect())->with('status', __('dashboard.messages.saved_successfully'));
    }
}
