<?php

namespace App\Http\Requests;

use App\Models\PriorityLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePriorityLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('priority_level_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:priority_levels',
            ],
            'turnaround_time' => [
                'string',
                'nullable',
            ],
            'color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
