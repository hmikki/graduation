<?php

namespace App\Http\Requests\Api\Notification;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\General\NotificationResource;
use App\Models\Notification;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed per_page
 */
class SearchRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
    public function attributes(): array
    {
        return [];
    }

    public function run(): JsonResponse
    {
        $Notifications = Notification::where('user_id',auth()->user()->getId())->orderBy('created_at','desc')->paginate($this->per_page?:10);
         return $this->successJsonResponse([],NotificationResource::collection($Notifications->items()),'Notifications',$Notifications);
    }
}
