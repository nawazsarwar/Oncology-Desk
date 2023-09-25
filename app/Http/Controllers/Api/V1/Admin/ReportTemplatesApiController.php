<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreReportTemplateRequest;
use App\Http\Requests\UpdateReportTemplateRequest;
use App\Http\Resources\Admin\ReportTemplateResource;
use App\Models\ReportTemplate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportTemplatesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('report_template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReportTemplateResource(ReportTemplate::with(['user'])->get());
    }

    public function store(StoreReportTemplateRequest $request)
    {
        $reportTemplate = ReportTemplate::create($request->all());

        return (new ReportTemplateResource($reportTemplate))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ReportTemplate $reportTemplate)
    {
        abort_if(Gate::denies('report_template_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReportTemplateResource($reportTemplate->load(['user']));
    }

    public function update(UpdateReportTemplateRequest $request, ReportTemplate $reportTemplate)
    {
        $reportTemplate->update($request->all());

        return (new ReportTemplateResource($reportTemplate))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ReportTemplate $reportTemplate)
    {
        abort_if(Gate::denies('report_template_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportTemplate->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
