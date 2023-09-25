<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPatientCategoryRequest;
use App\Http\Requests\StorePatientCategoryRequest;
use App\Http\Requests\UpdatePatientCategoryRequest;
use App\Models\PatientCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PatientCategoriesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('patient_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PatientCategory::query()->select(sprintf('%s.*', (new PatientCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'patient_category_show';
                $editGate      = 'patient_category_edit';
                $deleteGate    = 'patient_category_delete';
                $crudRoutePart = 'patient-categories';

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

        return view('admin.patientCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('patient_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientCategories.create');
    }

    public function store(StorePatientCategoryRequest $request)
    {
        $patientCategory = PatientCategory::create($request->all());

        return redirect()->route('admin.patient-categories.index');
    }

    public function edit(PatientCategory $patientCategory)
    {
        abort_if(Gate::denies('patient_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientCategories.edit', compact('patientCategory'));
    }

    public function update(UpdatePatientCategoryRequest $request, PatientCategory $patientCategory)
    {
        $patientCategory->update($request->all());

        return redirect()->route('admin.patient-categories.index');
    }

    public function show(PatientCategory $patientCategory)
    {
        abort_if(Gate::denies('patient_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientCategories.show', compact('patientCategory'));
    }

    public function destroy(PatientCategory $patientCategory)
    {
        abort_if(Gate::denies('patient_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientCategoryRequest $request)
    {
        $patientCategories = PatientCategory::find(request('ids'));

        foreach ($patientCategories as $patientCategory) {
            $patientCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
