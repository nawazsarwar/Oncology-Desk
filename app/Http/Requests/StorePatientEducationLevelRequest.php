<?php

namespace App\Http\Requests;

use App\Models\PatientEducationLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePatientEducationLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_education_level_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:patient_education_levels',
            ],
        ];
    }
}
