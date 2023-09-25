<?php

namespace App\Http\Requests;

use App\Models\ReportTemplate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReportTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('report_template_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'template' => [
                'required',
            ],
            'type' => [
                'required',
            ],
        ];
    }
}
