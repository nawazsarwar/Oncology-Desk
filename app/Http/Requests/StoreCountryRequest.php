<?php

namespace App\Http\Requests;

use App\Models\Country;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('country_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:countries',
            ],
            'code' => [
                'string',
                'required',
                'unique:countries',
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
