<?php

namespace App\Http\Requests;

use App\Models\ReportStatuss;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReportStatussRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('report_statuss_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:report_statusses,title,' . request()->route('report_statuss')->id,
            ],
            'color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
