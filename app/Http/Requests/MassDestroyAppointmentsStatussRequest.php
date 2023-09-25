<?php

namespace App\Http\Requests;

use App\Models\AppointmentsStatuss;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAppointmentsStatussRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('appointments_statuss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:appointments_statusses,id',
        ];
    }
}
