<?php

namespace App\Http\Requests;

use App\Models\PriorityLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePriorityLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('priority_level_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:priority_levels,title,' . request()->route('priority_level')->id,
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
