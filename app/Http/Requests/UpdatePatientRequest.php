<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_edit');
    }

    public function rules()
    {
        return [
            'registration_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'uhid_number' => [
                'string',
                'nullable',
            ],
            'abha' => [
                'string',
                'nullable',
            ],
            'mobile_number' => [
                'string',
                'required',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'middle_name' => [
                'string',
                'nullable',
            ],
            'last_name' => [
                'string',
                'nullable',
            ],
            'gender' => [
                'required',
            ],
            'dob' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'patient_age_in_years' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'patient_age_in_months' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'patient_age_in_days' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'identification_number' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'patient_category_id' => [
                'required',
                'integer',
            ],
            'gurdian_name' => [
                'string',
                'nullable',
            ],
            'mlc_number' => [
                'string',
                'nullable',
            ],
            'police_station' => [
                'string',
                'nullable',
            ],
            'mlc_remark' => [
                'string',
                'nullable',
            ],
            'referring_hospital' => [
                'string',
                'nullable',
            ],
            'referring_department' => [
                'string',
                'nullable',
            ],
            'reffered_on' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'referring_uhid' => [
                'string',
                'nullable',
            ],
        ];
    }
}
