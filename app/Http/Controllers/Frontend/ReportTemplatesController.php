<?php

namespace App\Http\Controllers\Frontend;

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

class ReportTemplatesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('report_template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportTemplates = ReportTemplate::with(['user'])->get();

        return view('frontend.reportTemplates.index', compact('reportTemplates'));
    }

    public function create()
    {
        abort_if(Gate::denies('report_template_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.reportTemplates.create', compact('users'));
    }

    public function store(StoreReportTemplateRequest $request)
    {
        $reportTemplate = ReportTemplate::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $reportTemplate->id]);
        }

        return redirect()->route('frontend.report-templates.index');
    }

    public function edit(ReportTemplate $reportTemplate)
    {
        abort_if(Gate::denies('report_template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reportTemplate->load('user');

        return view('frontend.reportTemplates.edit', compact('reportTemplate', 'users'));
    }

    public function update(UpdateReportTemplateRequest $request, ReportTemplate $reportTemplate)
    {
        $reportTemplate->update($request->all());

        return redirect()->route('frontend.report-templates.index');
    }

    public function show(ReportTemplate $reportTemplate)
    {
        abort_if(Gate::denies('report_template_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportTemplate->load('user');

        return view('frontend.reportTemplates.show', compact('reportTemplate'));
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
