<?php

namespace App\Http\Requests;

use App\Models\PatientGuardianRelationship;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPatientGuardianRelationshipRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('patient_guardian_relationship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:patient_guardian_relationships,id',
        ];
    }
}
