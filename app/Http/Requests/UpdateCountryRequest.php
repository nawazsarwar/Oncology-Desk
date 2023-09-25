<?php

namespace App\Http\Requests;

use App\Models\Country;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('country_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:countries,name,' . request()->route('country')->id,
            ],
            'code' => [
                'string',
                'required',
                'unique:countries,code,' . request()->route('country')->id,
            ],
            'dialing_code' => [
                'string',
                'required',
            ],
            'nationality' => [
                'string',
                'nullable',
            ],
            'sequence' => [
                'string',
                'nullable',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
