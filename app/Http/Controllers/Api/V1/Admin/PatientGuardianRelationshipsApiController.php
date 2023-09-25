<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientGuardianRelationshipRequest;
use App\Http\Requests\UpdatePatientGuardianRelationshipRequest;
use App\Http\Resources\Admin\PatientGuardianRelationshipResource;
use App\Models\PatientGuardianRelationship;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientGuardianRelationshipsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_guardian_relationship_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientGuardianRelationshipResource(PatientGuardianRelationship::all());
    }

    public function store(StorePatientGuardianRelationshipRequest $request)
    {
        $patientGuardianRelationship = PatientGuardianRelationship::create($request->all());

        return (new PatientGuardianRelationshipResource($patientGuardianRelationship))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PatientGuardianRelationship $patientGuardianRelationship)
    {
        abort_if(Gate::denies('patient_guardian_relationship_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientGuardianRelationshipResource($patientGuardianRelationship);
    }

    public function update(UpdatePatientGuardianRelationshipRequest $request, PatientGuardianRelationship $patientGuardianRelationship)
    {
        $patientGuardianRelationship->update($request->all());

        return (new PatientGuardianRelationshipResource($patientGuardianRelationship))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PatientGuardianRelationship $patientGuardianRelationship)
    {
        abort_if(Gate::denies('patient_guardian_relationship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientGuardianRelationship->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
