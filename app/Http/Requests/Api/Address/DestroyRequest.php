<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Requests\Api\ApiRequest;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class DestroyRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'address_id'=>'required|exists:addresses,id',
        ];
    }
    public function run(): JsonResponse
    {
        $Address =(new Address())->find($this->address_id);
        $Address->delete();
        return $this->successJsonResponse([__('messages.deleted_successfully')]);
    }
}
