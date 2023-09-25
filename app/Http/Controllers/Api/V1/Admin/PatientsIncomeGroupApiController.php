<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientsIncomeGroupRequest;
use App\Http\Requests\UpdatePatientsIncomeGroupRequest;
use App\Http\Resources\Admin\PatientsIncomeGroupResource;
use App\Models\PatientsIncomeGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientsIncomeGroupApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patients_income_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientsIncomeGroupResource(PatientsIncomeGroup::all());
    }

    public function store(StorePatientsIncomeGroupRequest $request)
    {
        $patientsIncomeGroup = PatientsIncomeGroup::create($request->all());

        return (new PatientsIncomeGroupResource($patientsIncomeGroup))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PatientsIncomeGroup $patientsIncomeGroup)
    {
        abort_if(Gate::denies('patients_income_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PatientsIncomeGroupResource($patientsIncomeGroup);
    }

    public function update(UpdatePatientsIncomeGroupRequest $request, PatientsIncomeGroup $patientsIncomeGroup)
    {
        $patientsIncomeGroup->update($request->all());

        return (new PatientsIncomeGroupResource($patientsIncomeGroup))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PatientsIncomeGroup $patientsIncomeGroup)
    {
        abort_if(Gate::denies('patients_income_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientsIncomeGroup->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
