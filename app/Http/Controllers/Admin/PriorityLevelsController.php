<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPriorityLevelRequest;
use App\Http\Requests\StorePriorityLevelRequest;
use App\Http\Requests\UpdatePriorityLevelRequest;
use App\Models\PriorityLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PriorityLevelsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('priority_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PriorityLevel::query()->select(sprintf('%s.*', (new PriorityLevel)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'priority_level_show';
                $editGate      = 'priority_level_edit';
                $deleteGate    = 'priority_level_delete';
                $crudRoutePart = 'priority-levels';

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
            $table->editColumn('turnaround_time', function ($row) {
                return $row->turnaround_time ? $row->turnaround_time : '';
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.priorityLevels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('priority_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.priorityLevels.create');
    }

    public function store(StorePriorityLevelRequest $request)
    {
        $priorityLevel = PriorityLevel::create($request->all());

        return redirect()->route('admin.priority-levels.index');
    }

    public function edit(PriorityLevel $priorityLevel)
    {
        abort_if(Gate::denies('priority_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.priorityLevels.edit', compact('priorityLevel'));
    }

    public function update(UpdatePriorityLevelRequest $request, PriorityLevel $priorityLevel)
    {
        $priorityLevel->update($request->all());

        return redirect()->route('admin.priority-levels.index');
    }

    public function show(PriorityLevel $priorityLevel)
    {
        abort_if(Gate::denies('priority_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.priorityLevels.show', compact('priorityLevel'));
    }

    public function destroy(PriorityLevel $priorityLevel)
    {
        abort_if(Gate::denies('priority_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priorityLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyPriorityLevelRequest $request)
    {
        $priorityLevels = PriorityLevel::find(request('ids'));

        foreach ($priorityLevels as $priorityLevel) {
            $priorityLevel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
