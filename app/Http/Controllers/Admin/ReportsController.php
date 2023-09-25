<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\ReportStatuss;
use App\Models\ReportTemplate;
use App\Models\Tag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Report::with(['appointment', 'status', 'template', 'allotted_to', 'finalized_by', 'approved_by', 'tags'])->select(sprintf('%s.*', (new Report)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'report_show';
                $editGate      = 'report_edit';
                $deleteGate    = 'report_delete';
                $crudRoutePart = 'reports';

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
            $table->addColumn('appointment_start_time', function ($row) {
                return $row->appointment ? $row->appointment->start_time : '';
            });

            $table->editColumn('summary', function ($row) {
                return $row->summary ? $row->summary : '';
            });
            $table->addColumn('status_title', function ($row) {
                return $row->status ? $row->status->title : '';
            });

            $table->addColumn('template_title', function ($row) {
                return $row->template ? $row->template->title : '';
            });

            $table->editColumn('special', function ($row) {
                return $row->special ? Report::SPECIAL_RADIO[$row->special] : '';
            });
            $table->editColumn('evolving', function ($row) {
                return $row->evolving ? $row->evolving : '';
            });
            $table->addColumn('allotted_to_name', function ($row) {
                return $row->allotted_to ? $row->allotted_to->name : '';
            });

            $table->addColumn('finalized_by_name', function ($row) {
                return $row->finalized_by ? $row->finalized_by->name : '';
            });

            $table->addColumn('approved_by_name', function ($row) {
                return $row->approved_by ? $row->approved_by->name : '';
            });

            $table->editColumn('tags', function ($row) {
                $labels = [];
                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'appointment', 'status', 'template', 'allotted_to', 'finalized_by', 'approved_by', 'tags']);

            return $table->make(true);
        }

        return view('admin.reports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::pluck('start_time', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = ReportStatuss::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $templates = ReportTemplate::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $allotted_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finalized_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::pluck('name', 'id');

        return view('admin.reports.create', compact('allotted_tos', 'appointments', 'approved_bies', 'finalized_bies', 'statuses', 'tags', 'templates'));
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());
        $report->tags()->sync($request->input('tags', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $report->id]);
        }

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::pluck('start_time', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = ReportStatuss::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $templates = ReportTemplate::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $allotted_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finalized_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approved_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::pluck('name', 'id');

        $report->load('appointment', 'status', 'template', 'allotted_to', 'finalized_by', 'approved_by', 'tags');

        return view('admin.reports.edit', compact('allotted_tos', 'appointments', 'approved_bies', 'finalized_bies', 'report', 'statuses', 'tags', 'templates'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());
        $report->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('appointment', 'status', 'template', 'allotted_to', 'finalized_by', 'approved_by', 'tags');

        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        $reports = Report::find(request('ids'));

        foreach ($reports as $report) {
            $report->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('report_create') && Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Report();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
