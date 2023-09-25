<?php

namespace App\Http\Requests;

use App\Models\Facility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFacilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facility_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:facilities,name,' . request()->route('facility')->id,
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
