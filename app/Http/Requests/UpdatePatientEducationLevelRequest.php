<?php

namespace App\Http\Requests;

use App\Models\PatientEducationLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatientEducationLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_education_level_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:patient_education_levels,title,' . request()->route('patient_education_level')->id,
            ],
        ];
    }
}
