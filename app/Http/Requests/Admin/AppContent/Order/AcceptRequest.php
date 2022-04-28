<?php

namespace App\Http\Requests\Admin\AppContent\Order;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Mail\AcceptFormMail;
use App\Mail\ForgetPasswordMail;
use App\Mail\VerificationDoneMail;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;

class AcceptRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function preset($crud,$id)
    {
        $Object = User::find($id);
        if (!$Object) {
            return $crud->wrongData();
        } else {
            if (auth('dashboard')->user()->getType() == Constant::USER_TYPE['Doctor']) {

                $Object->setStatus(Constant::ORDER_STATUSES['Accepted']);
                Mail::to($Object)->send(new AcceptFormMail('Your application form is accepted by the doctor'));

            } elseif (auth('dashboard')->user()->getType() == Constant::USER_TYPE['Supervisor']) {

                $Object->setStatus(Constant::ORDER_STATUSES['Finished']);
                Mail::to($Object)->send(new AcceptFormMail('Your application form is accepted by the Supervisor'));
            }
            $Object->save();
            $Object->refresh();
            return redirect()->back()->with('status', __('dashboard.messages.saved_successfully'));
        }
    }
}
