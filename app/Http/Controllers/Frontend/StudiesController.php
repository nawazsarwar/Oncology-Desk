<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudyRequest;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\UpdateStudyRequest;
use App\Models\Facility;
use App\Models\Modality;
use App\Models\Study;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudiesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('study_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studies = Study::with(['modality', 'facility'])->get();

        return view('frontend.studies.index', compact('studies'));
    }

    public function create()
    {
        abort_if(Gate::denies('study_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modalities = Modality::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.studies.create', compact('facilities', 'modalities'));
    }

    public function store(StoreStudyRequest $request)
    {
        $study = Study::create($request->all());

        return redirect()->route('frontend.studies.index');
    }

    public function edit(Study $study)
    {
        abort_if(Gate::denies('study_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modalities = Modality::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $study->load('modality', 'facility');

        return view('frontend.studies.edit', compact('facilities', 'modalities', 'study'));
    }

    public function update(UpdateStudyRequest $request, Study $study)
    {
        $study->update($request->all());

        return redirect()->route('frontend.studies.index');
    }

    public function show(Study $study)
    {
        abort_if(Gate::denies('study_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $study->load('modality', 'facility');

        return view('frontend.studies.show', compact('study'));
    }

    public function destroy(Study $study)
    {
        abort_if(Gate::denies('study_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $study->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudyRequest $request)
    {
        $studies = Study::find(request('ids'));

        foreach ($studies as $study) {
            $study->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
