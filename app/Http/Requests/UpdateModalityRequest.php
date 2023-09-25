<?php

namespace App\Http\Requests;

use App\Models\Modality;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateModalityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('modality_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'code' => [
                'string',
                'nullable',
            ],
            'facility_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
