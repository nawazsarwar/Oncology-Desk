<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_edit');
    }

    public function rules()
    {
        return [
            'patient_id' => [
                'required',
                'integer',
            ],
            'studies.*' => [
                'integer',
            ],
            'studies' => [
                'required',
                'array',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'finish_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'contrast' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'films' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'history_documents' => [
                'array',
            ],
            'added_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
