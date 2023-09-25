<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientCategoryRequest;
use App\Http\Requests\UpdatePatientCategoryRequest;
use App\Http\Resources\Admin\PatientCategoryResource;
use App\Models\PatientCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientCategoriesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientCategoryResource(PatientCategory::all());
    }

    public function store(StorePatientCategoryRequest $request)
    {
        $patientCategory = PatientCategory::create($request->all());

        return (new PatientCategoryResource($patientCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PatientCategory $patientCategory)
    {
        abort_if(Gate::denies('patient_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientCategoryResource($patientCategory);
    }

    public function update(UpdatePatientCategoryRequest $request, PatientCategory $patientCategory)
    {
        $patientCategory->update($request->all());

        return (new PatientCategoryResource($patientCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PatientCategory $patientCategory)
    {
        abort_if(Gate::denies('patient_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
