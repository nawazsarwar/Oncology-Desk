<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\UpdateStudyRequest;
use App\Http\Resources\Admin\StudyResource;
use App\Models\Study;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudiesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('study_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudyResource(Study::with(['modality', 'facility'])->get());
    }

    public function store(StoreStudyRequest $request)
    {
        $study = Study::create($request->all());

        return (new StudyResource($study))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Study $study)
    {
        abort_if(Gate::denies('study_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudyResource($study->load(['modality', 'facility']));
    }

    public function update(UpdateStudyRequest $request, Study $study)
    {
        $study->update($request->all());

        return (new StudyResource($study))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Study $study)
    {
        abort_if(Gate::denies('study_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $study->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
