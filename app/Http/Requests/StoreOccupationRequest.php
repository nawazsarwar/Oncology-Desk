<?php

namespace App\Http\Requests;

use App\Models\Occupation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOccupationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('occupation_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:occupations',
            ],
        ];
    }
}
