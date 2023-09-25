<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyReportTemplateRequest;
use App\Http\Requests\StoreReportTemplateRequest;
use App\Http\Requests\UpdateReportTemplateRequest;
use App\Models\ReportTemplate;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportTemplatesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('report_template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ReportTemplate::with(['user'])->select(sprintf('%s.*', (new ReportTemplate)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'report_template_show';
                $editGate      = 'report_template_edit';
                $deleteGate    = 'report_template_delete';
                $crudRoutePart = 'report-templates';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? ReportTemplate::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ReportTemplate::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.reportTemplates.index');
    }

    public function create()
    {
        abort_if(Gate::denies('report_template_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reportTemplates.create', compact('users'));
    }

    public function store(StoreReportTemplateRequest $request)
    {
        $reportTemplate = ReportTemplate::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $reportTemplate->id]);
        }

        return redirect()->route('admin.report-templates.index');
    }

    public function edit(ReportTemplate $reportTemplate)
    {
        abort_if(Gate::denies('report_template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reportTemplate->load('user');

        return view('admin.reportTemplates.edit', compact('reportTemplate', 'users'));
    }

    public function update(UpdateReportTemplateRequest $request, ReportTemplate $reportTemplate)
    {
        $reportTemplate->update($request->all());

        return redirect()->route('admin.report-templates.index');
    }

    public function show(ReportTemplate $reportTemplate)
    {
        abort_if(Gate::denies('report_template_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportTemplate->load('user');

        return view('admin.reportTemplates.show', compact('reportTemplate'));
    }

    public function destroy(ReportTemplate $reportTemplate)
    {
        abort_if(Gate::denies('report_template_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportTemplate->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportTemplateRequest $request)
    {
        $reportTemplates = ReportTemplate::find(request('ids'));

        foreach ($reportTemplates as $reportTemplate) {
            $reportTemplate->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('report_template_create') && Gate::denies('report_template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ReportTemplate();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
