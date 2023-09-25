<?php

namespace App\Http\Requests;

use App\Models\PatientGuardianRelationship;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePatientGuardianRelationshipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('patient_guardian_relationship_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:patient_guardian_relationships,title,' . request()->route('patient_guardian_relationship')->id,
            ],
        ];
    }
}
