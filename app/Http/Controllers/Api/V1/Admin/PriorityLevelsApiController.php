<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePriorityLevelRequest;
use App\Http\Requests\UpdatePriorityLevelRequest;
use App\Http\Resources\Admin\PriorityLevelResource;
use App\Models\PriorityLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriorityLevelsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('priority_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PriorityLevelResource(PriorityLevel::all());
    }

    public function store(StorePriorityLevelRequest $request)
    {
        $priorityLevel = PriorityLevel::create($request->all());

        return (new PriorityLevelResource($priorityLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PriorityLevel $priorityLevel)
    {
        abort_if(Gate::denies('priority_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PriorityLevelResource($priorityLevel);
    }

    public function update(UpdatePriorityLevelRequest $request, PriorityLevel $priorityLevel)
    {
        $priorityLevel->update($request->all());

        return (new PriorityLevelResource($priorityLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PriorityLevel $priorityLevel)
    {
        abort_if(Gate::denies('priority_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $priorityLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
