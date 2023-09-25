<?php

namespace App\Http\Requests;

use App\Models\AppointmentsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentsTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointments_type_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:appointments_types',
            ],
            'color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
