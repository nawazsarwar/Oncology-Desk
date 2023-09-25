<?php

namespace App\Http\Requests;

use App\Models\AppointmentsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppointmentsTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointments_type_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:appointments_types,title,' . request()->route('appointments_type')->id,
            ],
            'color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
