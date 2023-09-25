<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPatientsIncomeGroupRequest;
use App\Http\Requests\StorePatientsIncomeGroupRequest;
use App\Http\Requests\UpdatePatientsIncomeGroupRequest;
use App\Models\PatientsIncomeGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PatientsIncomeGroupController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('patients_income_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PatientsIncomeGroup::query()->select(sprintf('%s.*', (new PatientsIncomeGroup)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'patients_income_group_show';
                $editGate      = 'patients_income_group_edit';
                $deleteGate    = 'patients_income_group_delete';
                $crudRoutePart = 'patients-income-groups';

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

        return view('admin.patientsIncomeGroups.index');
    }

    public function create()
    {
        abort_if(Gate::denies('patients_income_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientsIncomeGroups.create');
    }

    public function store(StorePatientsIncomeGroupRequest $request)
    {
        $patientsIncomeGroup = PatientsIncomeGroup::create($request->all());

        return redirect()->route('admin.patients-income-groups.index');
    }

    public function edit(PatientsIncomeGroup $patientsIncomeGroup)
    {
        abort_if(Gate::denies('patients_income_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientsIncomeGroups.edit', compact('patientsIncomeGroup'));
    }

    public function update(UpdatePatientsIncomeGroupRequest $request, PatientsIncomeGroup $patientsIncomeGroup)
    {
        $patientsIncomeGroup->update($request->all());

        return redirect()->route('admin.patients-income-groups.index');
    }

    public function show(PatientsIncomeGroup $patientsIncomeGroup)
    {
        abort_if(Gate::denies('patients_income_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.patientsIncomeGroups.show', compact('patientsIncomeGroup'));
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
