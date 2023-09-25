<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientEducationLevelRequest;
use App\Http\Requests\UpdatePatientEducationLevelRequest;
use App\Http\Resources\Admin\PatientEducationLevelResource;
use App\Models\PatientEducationLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientEducationLevelsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_education_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientEducationLevelResource(PatientEducationLevel::all());
    }

    public function store(StorePatientEducationLevelRequest $request)
    {
        $patientEducationLevel = PatientEducationLevel::create($request->all());

        return (new PatientEducationLevelResource($patientEducationLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PatientEducationLevel $patientEducationLevel)
    {
        abort_if(Gate::denies('patient_education_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientEducationLevelResource($patientEducationLevel);
    }

    public function update(UpdatePatientEducationLevelRequest $request, PatientEducationLevel $patientEducationLevel)
    {
        $patientEducationLevel->update($request->all());

        return (new PatientEducationLevelResource($patientEducationLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PatientEducationLevel $patientEducationLevel)
    {
        abort_if(Gate::denies('patient_education_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientEducationLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
