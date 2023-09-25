<?php

namespace App\Http\Requests;

use App\Models\AppointmentsStatuss;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentsStatussRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointments_statuss_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:appointments_statusses',
            ],
            'color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
