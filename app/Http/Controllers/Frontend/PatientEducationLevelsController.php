<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPatientEducationLevelRequest;
use App\Http\Requests\StorePatientEducationLevelRequest;
use App\Http\Requests\UpdatePatientEducationLevelRequest;
use App\Models\PatientEducationLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientEducationLevelsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_education_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientEducationLevels = PatientEducationLevel::all();

        return view('frontend.patientEducationLevels.index', compact('patientEducationLevels'));
    }

    public function create()
    {
        abort_if(Gate::denies('patient_education_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientEducationLevels.create');
    }

    public function store(StorePatientEducationLevelRequest $request)
    {
        $patientEducationLevel = PatientEducationLevel::create($request->all());

        return redirect()->route('frontend.patient-education-levels.index');
    }

    public function edit(PatientEducationLevel $patientEducationLevel)
    {
        abort_if(Gate::denies('patient_education_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientEducationLevels.edit', compact('patientEducationLevel'));
    }

    public function update(UpdatePatientEducationLevelRequest $request, PatientEducationLevel $patientEducationLevel)
    {
        $patientEducationLevel->update($request->all());

        return redirect()->route('frontend.patient-education-levels.index');
    }

    public function show(PatientEducationLevel $patientEducationLevel)
    {
        abort_if(Gate::denies('patient_education_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientEducationLevels.show', compact('patientEducationLevel'));
    }

    public function destroy(PatientEducationLevel $patientEducationLevel)
    {
        abort_if(Gate::denies('patient_education_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientEducationLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientEducationLevelRequest $request)
    {
        $patientEducationLevels = PatientEducationLevel::find(request('ids'));

        foreach ($patientEducationLevels as $patientEducationLevel) {
            $patientEducationLevel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
