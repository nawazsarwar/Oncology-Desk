<?php

namespace App\Http\Requests;

use App\Models\Facility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFacilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facility_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:facilities',
            ],
            'location' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'phone_no' => [
                'string',
                'nullable',
            ],
        ];
    }
}
