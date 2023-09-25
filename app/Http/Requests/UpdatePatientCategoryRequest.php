<?php

namespace App\Http\Requests;

use App\Models\PatientCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatientCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_category_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:patient_categories,title,' . request()->route('patient_category')->id,
            ],
        ];
    }
}
