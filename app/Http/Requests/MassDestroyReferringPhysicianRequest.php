<?php

namespace App\Http\Requests;

use App\Models\ReferringPhysician;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyReferringPhysicianRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('referring_physician_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:referring_physicians,id',
        ];
    }
}
