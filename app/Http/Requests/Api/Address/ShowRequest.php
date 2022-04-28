<?php

namespace App\Http\Requests\Api\Address;

use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Address\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'address_id'=>'required|exists:addresses,id'
        ];
    }
    public function run(): JsonResponse
    {
        return $this->successJsonResponse([],new AddressResource((new Address())->find($this->address_id)),'Address');
    }
}
