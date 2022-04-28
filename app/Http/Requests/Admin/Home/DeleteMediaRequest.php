<?php

namespace App\Http\Requests\Admin\Home;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Models\Media;
use App\Traits\AhmedPanelTrait;
use Illuminate\Foundation\Http\FormRequest;

class DeleteMediaRequest extends FormRequest
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
        ];
    }
    public function preset()
    {
        $Object = (new Media())->find($this->media_id);
        if (!$Object) {
            return redirect()->back()->withErrors(__('dashboard.messages.wrong_data'));
        } else {
            $Object->delete();
            return redirect()->back()->with('status', __('dashboard.messages.deleted_successfully'));
        }
    }
}
