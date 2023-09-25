<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPatientGuardianRelationshipRequest;
use App\Http\Requests\StorePatientGuardianRelationshipRequest;
use App\Http\Requests\UpdatePatientGuardianRelationshipRequest;
use App\Models\PatientGuardianRelationship;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PatientGuardianRelationshipsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('patient_guardian_relationship_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PatientGuardianRelationship::query()->select(sprintf('%s.*', (new PatientGuardianRelationship)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'patient_guardian_relationship_show';
                $editGate      = 'patient_guardian_relationship_edit';
                $deleteGate    = 'patient_guardian_relationship_delete';
                $crudRoutePart = 'patient-guardian-relationships';

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

        return view('admin.patientGuardianRelationships.index');
    }

    public function create()
    {
        abort_if(Gate::denies('patient_guardian_relationship_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientGuardianRelationships.create');
    }

    public function store(StorePatientGuardianRelationshipRequest $request)
    {
        $patientGuardianRelationship = PatientGuardianRelationship::create($request->all());

        return redirect()->route('admin.patient-guardian-relationships.index');
    }

    public function edit(PatientGuardianRelationship $patientGuardianRelationship)
    {
        abort_if(Gate::denies('patient_guardian_relationship_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientGuardianRelationships.edit', compact('patientGuardianRelationship'));
    }

    public function update(UpdatePatientGuardianRelationshipRequest $request, PatientGuardianRelationship $patientGuardianRelationship)
    {
        $patientGuardianRelationship->update($request->all());

        return redirect()->route('admin.patient-guardian-relationships.index');
    }

    public function show(PatientGuardianRelationship $patientGuardianRelationship)
    {
        abort_if(Gate::denies('patient_guardian_relationship_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientGuardianRelationships.show', compact('patientGuardianRelationship'));
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
