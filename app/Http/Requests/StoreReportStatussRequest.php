<?php

namespace App\Http\Requests;

use App\Models\ReportStatuss;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReportStatussRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('report_statuss_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:report_statusses',
            ],
            'color' => [
                'string',
                'nullable',
            ],
        ];
    }
}
