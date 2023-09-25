<?php

namespace App\Http\Requests;

use App\Models\PatientsIncomeGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePatientsIncomeGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patients_income_group_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:patients_income_groups',
            ],
        ];
    }
}
