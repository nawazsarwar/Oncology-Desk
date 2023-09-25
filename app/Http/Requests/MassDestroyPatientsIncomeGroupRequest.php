<?php

namespace App\Http\Requests;

use App\Models\PatientsIncomeGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPatientsIncomeGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('patients_income_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:patients_income_groups,id',
        ];
    }
}
