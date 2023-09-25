<?php

namespace App\Http\Requests;

use App\Models\AppointmentsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAppointmentsTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('appointments_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:appointments_types,id',
        ];
    }
}
