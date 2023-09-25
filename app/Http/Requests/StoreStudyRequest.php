<?php

namespace App\Http\Requests;

use App\Models\Study;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('study_create');
    }

    public function rules()
    {
        return [
            'modality_id' => [
                'required',
                'integer',
            ],
            'type' => [
                'string',
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
            'fee' => [
                'required',
            ],
            'maximum_slots' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'time_per_slot' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'films' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'weightage' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'facility_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
