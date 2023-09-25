<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class StudiesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('study_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Study::with(['modality', 'facility'])->select(sprintf('%s.*', (new Study)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'study_show';
                $editGate      = 'study_edit';
                $deleteGate    = 'study_delete';
                $crudRoutePart = 'studies';

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
            $table->addColumn('modality_name', function ($row) {
                return $row->modality ? $row->modality->name : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('fee', function ($row) {
                return $row->fee ? $row->fee : '';
            });
            $table->editColumn('maximum_slots', function ($row) {
                return $row->maximum_slots ? $row->maximum_slots : '';
            });
            $table->editColumn('time_per_slot', function ($row) {
                return $row->time_per_slot ? $row->time_per_slot : '';
            });
            $table->editColumn('films', function ($row) {
                return $row->films ? $row->films : '';
            });
            $table->editColumn('weightage', function ($row) {
                return $row->weightage ? $row->weightage : '';
            });
            $table->addColumn('facility_name', function ($row) {
                return $row->facility ? $row->facility->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Study::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'modality', 'facility']);

            return $table->make(true);
        }

        return view('admin.studies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('study_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modalities = Modality::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studies.create', compact('facilities', 'modalities'));
    }

    public function store(StoreStudyRequest $request)
    {
        $study = Study::create($request->all());

        return redirect()->route('admin.studies.index');
    }

    public function edit(Study $study)
    {
        abort_if(Gate::denies('study_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modalities = Modality::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $study->load('modality', 'facility');

        return view('admin.studies.edit', compact('facilities', 'modalities', 'study'));
    }

    public function update(UpdateStudyRequest $request, Study $study)
    {
        $study->update($request->all());

        return redirect()->route('admin.studies.index');
    }

    public function show(Study $study)
    {
        abort_if(Gate::denies('study_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $study->load('modality', 'facility');

        return view('admin.studies.show', compact('study'));
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
