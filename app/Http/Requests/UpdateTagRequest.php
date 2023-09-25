<?php

namespace App\Http\Requests;

use App\Models\Tag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tag_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:tags,name,' . request()->route('tag')->id,
            ],
            'slug' => [
                'string',
                'required',
                'unique:tags,slug,' . request()->route('tag')->id,
            ],
        ];
    }
}
