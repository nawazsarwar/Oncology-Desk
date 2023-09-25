<?php

namespace App\Http\Requests;

use App\Models\AppointmentsStatuss;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppointmentsStatussRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointments_statuss_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:appointments_statusses,title,' . request()->route('appointments_statuss')->id,
            ],
            'color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
