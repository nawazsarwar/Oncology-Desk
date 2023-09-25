<?php

namespace App\Http\Requests;

use App\Models\PatientCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPatientCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('patient_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:patient_categories,id',
        ];
    }
}
