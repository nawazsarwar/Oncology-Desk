<?php

namespace App\Http\Requests;

use App\Models\Occupation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOccupationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('occupation_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:occupations,title,' . request()->route('occupation')->id,
            ],
        ];
    }
}
