<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySalutationRequest;
use App\Http\Requests\StoreSalutationRequest;
use App\Http\Requests\UpdateSalutationRequest;
use App\Models\Salutation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SalutationsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('salutation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Salutation::query()->select(sprintf('%s.*', (new Salutation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'salutation_show';
                $editGate      = 'salutation_edit';
                $deleteGate    = 'salutation_delete';
                $crudRoutePart = 'salutations';

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

        return view('admin.salutations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('salutation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salutations.create');
    }

    public function store(StoreSalutationRequest $request)
    {
        $salutation = Salutation::create($request->all());

        return redirect()->route('admin.salutations.index');
    }

    public function edit(Salutation $salutation)
    {
        abort_if(Gate::denies('salutation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salutations.edit', compact('salutation'));
    }

    public function update(UpdateSalutationRequest $request, Salutation $salutation)
    {
        $salutation->update($request->all());

        return redirect()->route('admin.salutations.index');
    }

    public function show(Salutation $salutation)
    {
        abort_if(Gate::denies('salutation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salutations.show', compact('salutation'));
    }

    public function destroy(Salutation $salutation)
    {
        abort_if(Gate::denies('salutation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salutation->delete();

        return back();
    }

    public function massDestroy(MassDestroySalutationRequest $request)
    {
        $salutations = Salutation::find(request('ids'));

        foreach ($salutations as $salutation) {
            $salutation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
