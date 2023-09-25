<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPatientGuardianRelationshipRequest;
use App\Http\Requests\StorePatientGuardianRelationshipRequest;
use App\Http\Requests\UpdatePatientGuardianRelationshipRequest;
use App\Models\PatientGuardianRelationship;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientGuardianRelationshipsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_guardian_relationship_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientGuardianRelationships = PatientGuardianRelationship::all();

        return view('frontend.patientGuardianRelationships.index', compact('patientGuardianRelationships'));
    }

    public function create()
    {
        abort_if(Gate::denies('patient_guardian_relationship_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientGuardianRelationships.create');
    }

    public function store(StorePatientGuardianRelationshipRequest $request)
    {
        $patientGuardianRelationship = PatientGuardianRelationship::create($request->all());

        return redirect()->route('frontend.patient-guardian-relationships.index');
    }

    public function edit(PatientGuardianRelationship $patientGuardianRelationship)
    {
        abort_if(Gate::denies('patient_guardian_relationship_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientGuardianRelationships.edit', compact('patientGuardianRelationship'));
    }

    public function update(UpdatePatientGuardianRelationshipRequest $request, PatientGuardianRelationship $patientGuardianRelationship)
    {
        $patientGuardianRelationship->update($request->all());

        return redirect()->route('frontend.patient-guardian-relationships.index');
    }

    public function show(PatientGuardianRelationship $patientGuardianRelationship)
    {
        abort_if(Gate::denies('patient_guardian_relationship_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientGuardianRelationships.show', compact('patientGuardianRelationship'));
    }

    public function destroy(PatientGuardianRelationship $patientGuardianRelationship)
    {
        abort_if(Gate::denies('patient_guardian_relationship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientGuardianRelationship->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientGuardianRelationshipRequest $request)
    {
        $patientGuardianRelationships = PatientGuardianRelationship::find(request('ids'));

        foreach ($patientGuardianRelationships as $patientGuardianRelationship) {
            $patientGuardianRelationship->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
