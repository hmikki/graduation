<?php

namespace App\Http\Requests\Admin\AppContent\Order;

use App\Helpers\Constant;
use App\Mail\AcceptFormMail;
use App\Mail\VerificationDoneMail;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class RejectRequest extends FormRequest
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
            $Object->setStatus(Constant::ORDER_STATUSES['Rejected']);
            Mail::to($Object)->send(new AcceptFormMail('Your application form is rejected'));
            $Object->save();
            $Object->refresh();
            return redirect()->back()->with('status', __('dashboard.messages.saved_successfully'));
        }
    }
}
