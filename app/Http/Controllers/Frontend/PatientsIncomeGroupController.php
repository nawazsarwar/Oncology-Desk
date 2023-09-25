<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPatientsIncomeGroupRequest;
use App\Http\Requests\StorePatientsIncomeGroupRequest;
use App\Http\Requests\UpdatePatientsIncomeGroupRequest;
use App\Models\PatientsIncomeGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientsIncomeGroupController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('patients_income_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientsIncomeGroups = PatientsIncomeGroup::all();

        return view('frontend.patientsIncomeGroups.index', compact('patientsIncomeGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('patients_income_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientsIncomeGroups.create');
    }

    public function store(StorePatientsIncomeGroupRequest $request)
    {
        $patientsIncomeGroup = PatientsIncomeGroup::create($request->all());

        return redirect()->route('frontend.patients-income-groups.index');
    }

    public function edit(PatientsIncomeGroup $patientsIncomeGroup)
    {
        abort_if(Gate::denies('patients_income_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientsIncomeGroups.edit', compact('patientsIncomeGroup'));
    }

    public function update(UpdatePatientsIncomeGroupRequest $request, PatientsIncomeGroup $patientsIncomeGroup)
    {
        $patientsIncomeGroup->update($request->all());

        return redirect()->route('frontend.patients-income-groups.index');
    }

    public function show(PatientsIncomeGroup $patientsIncomeGroup)
    {
        abort_if(Gate::denies('patients_income_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.patientsIncomeGroups.show', compact('patientsIncomeGroup'));
    }

    public function destroy(PatientsIncomeGroup $patientsIncomeGroup)
    {
        abort_if(Gate::denies('patients_income_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patientsIncomeGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientsIncomeGroupRequest $request)
    {
        $patientsIncomeGroups = PatientsIncomeGroup::find(request('ids'));

        foreach ($patientsIncomeGroups as $patientsIncomeGroup) {
            $patientsIncomeGroup->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
