<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOccupationRequest;
use App\Http\Requests\StoreOccupationRequest;
use App\Http\Requests\UpdateOccupationRequest;
use App\Models\Occupation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OccupationsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('occupation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Occupation::query()->select(sprintf('%s.*', (new Occupation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'occupation_show';
                $editGate      = 'occupation_edit';
                $deleteGate    = 'occupation_delete';
                $crudRoutePart = 'occupations';

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

        return view('admin.occupations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('occupation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.occupations.create');
    }

    public function store(StoreOccupationRequest $request)
    {
        $occupation = Occupation::create($request->all());

        return redirect()->route('admin.occupations.index');
    }

    public function edit(Occupation $occupation)
    {
        abort_if(Gate::denies('occupation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.occupations.edit', compact('occupation'));
    }

    public function update(UpdateOccupationRequest $request, Occupation $occupation)
    {
        $occupation->update($request->all());

        return redirect()->route('admin.occupations.index');
    }

    public function show(Occupation $occupation)
    {
        abort_if(Gate::denies('occupation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.occupations.show', compact('occupation'));
    }

    public function destroy(Occupation $occupation)
    {
        abort_if(Gate::denies('occupation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $occupation->delete();

        return back();
    }

    public function massDestroy(MassDestroyOccupationRequest $request)
    {
        $occupations = Occupation::find(request('ids'));

        foreach ($occupations as $occupation) {
            $occupation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
