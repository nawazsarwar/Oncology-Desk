<?php

namespace App\Http\Requests;

use App\Models\PatientsIncomeGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatientsIncomeGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patients_income_group_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:patients_income_groups,title,' . request()->route('patients_income_group')->id,
            ],
        ];
    }
}
