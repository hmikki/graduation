<?php

namespace App\Http\Requests;

use App\Helpers\Constant;
use App\Helpers\Functions;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SubmitApplicationRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_name' => 'required|string',
            'student_track' => 'required|string|min:6',
            'section_no' => 'required',
            'project_title' => 'required|string',
            'project_type' => 'required',
            'problem' => 'required|string',
            'solution' => 'required|string',
            'device_token' => 'string|required_with:device',
            'device_type' => 'string|required_with:device_token',
        ];
    }
    public function attributes(): array
    {
        return [];
    }
    public function persist()
    {
        $logged = auth()->user();
        $user = User::find($logged->getId());
        $user->setStudentName($this->student_name);
        $user->setStudentTrack($this->student_track);
        $user->setSectionNo($this->section_no);
        $user->setProjectTitle($this->project_title);
        $user->setProjectType($this->project_type);
        $user->setProblem($this->problem);
        $user->setSolution($this->solution);
        $user->setStatus(Constant::ORDER_STATUSES['New']);
        if ($this->filled('device_token') && $this->filled('device_type')) {
            $user->setDeviceToken($this->device_token);
            $user->setDeviceType($this->device_type);
        }
        $user->save();
        return redirect()->back()->with(['success'=>__('messages.success_submit')]);
    }

}
