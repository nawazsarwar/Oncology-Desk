<?php

namespace App\Http\Requests;

use App\Models\PatientEducationLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPatientEducationLevelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('patient_education_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:patient_education_levels,id',
        ];
    }
}
