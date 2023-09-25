<?php

namespace App\Http\Requests;

use App\Models\PriorityLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPriorityLevelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('priority_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:priority_levels,id',
        ];
    }
}
