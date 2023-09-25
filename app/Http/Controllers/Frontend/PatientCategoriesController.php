<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPatientCategoryRequest;
use App\Http\Requests\StorePatientCategoryRequest;
use App\Http\Requests\UpdatePatientCategoryRequest;
use App\Models\PatientCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientCategoriesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientCategories = PatientCategory::all();

        return view('frontend.patientCategories.index', compact('patientCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('patient_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientCategories.create');
    }

    public function store(StorePatientCategoryRequest $request)
    {
        $patientCategory = PatientCategory::create($request->all());

        return redirect()->route('frontend.patient-categories.index');
    }

    public function edit(PatientCategory $patientCategory)
    {
        abort_if(Gate::denies('patient_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientCategories.edit', compact('patientCategory'));
    }

    public function update(UpdatePatientCategoryRequest $request, PatientCategory $patientCategory)
    {
        $patientCategory->update($request->all());

        return redirect()->route('frontend.patient-categories.index');
    }

    public function show(PatientCategory $patientCategory)
    {
        abort_if(Gate::denies('patient_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientCategories.show', compact('patientCategory'));
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
