<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPatientEducationLevelRequest;
use App\Http\Requests\StorePatientEducationLevelRequest;
use App\Http\Requests\UpdatePatientEducationLevelRequest;
use App\Models\PatientEducationLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PatientEducationLevelsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('patient_education_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PatientEducationLevel::query()->select(sprintf('%s.*', (new PatientEducationLevel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'patient_education_level_show';
                $editGate      = 'patient_education_level_edit';
                $deleteGate    = 'patient_education_level_delete';
                $crudRoutePart = 'patient-education-levels';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.patientEducationLevels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('patient_education_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientEducationLevels.create');
    }

    public function store(StorePatientEducationLevelRequest $request)
    {
        $patientEducationLevel = PatientEducationLevel::create($request->all());

        return redirect()->route('admin.patient-education-levels.index');
    }

    public function edit(PatientEducationLevel $patientEducationLevel)
    {
        abort_if(Gate::denies('patient_education_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientEducationLevels.edit', compact('patientEducationLevel'));
    }

    public function update(UpdatePatientEducationLevelRequest $request, PatientEducationLevel $patientEducationLevel)
    {
        $patientEducationLevel->update($request->all());

        return redirect()->route('admin.patient-education-levels.index');
    }

    public function show(PatientEducationLevel $patientEducationLevel)
    {
        abort_if(Gate::denies('patient_education_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientEducationLevels.show', compact('patientEducationLevel'));
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
