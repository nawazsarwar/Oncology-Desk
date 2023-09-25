<?php

namespace App\Http\Requests;

use App\Models\ReferringPhysician;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReferringPhysicianRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('referring_physician_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'mobile_no' => [
                'string',
                'nullable',
            ],
            'department' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
        ];
    }
}
