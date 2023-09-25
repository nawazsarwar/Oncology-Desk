<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\Admin\PatientResource;
use App\Models\Patient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientResource(Patient::with(['salutation', 'postal_code', 'patient_category', 'user', 'province', 'district', 'relationship', 'nationality', 'occupation', 'education', 'yearly_income', 'referred_by'])->get());
    }

    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->all());

        return (new PatientResource($patient))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientResource($patient->load(['salutation', 'postal_code', 'patient_category', 'user', 'province', 'district', 'relationship', 'nationality', 'occupation', 'education', 'yearly_income', 'referred_by']));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->all());

        return (new PatientResource($patient))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Patient $patient)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
