<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPriorityLevelRequest;
use App\Http\Requests\StorePriorityLevelRequest;
use App\Http\Requests\UpdatePriorityLevelRequest;
use App\Models\PriorityLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriorityLevelsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('priority_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priorityLevels = PriorityLevel::all();

        return view('frontend.priorityLevels.index', compact('priorityLevels'));
    }

    public function create()
    {
        abort_if(Gate::denies('priority_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.priorityLevels.create');
    }

    public function store(StorePriorityLevelRequest $request)
    {
        $priorityLevel = PriorityLevel::create($request->all());

        return redirect()->route('frontend.priority-levels.index');
    }

    public function edit(PriorityLevel $priorityLevel)
    {
        abort_if(Gate::denies('priority_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.priorityLevels.edit', compact('priorityLevel'));
    }

    public function update(UpdatePriorityLevelRequest $request, PriorityLevel $priorityLevel)
    {
        $priorityLevel->update($request->all());

        return redirect()->route('frontend.priority-levels.index');
    }

    public function show(PriorityLevel $priorityLevel)
    {
        abort_if(Gate::denies('priority_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.priorityLevels.show', compact('priorityLevel'));
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
