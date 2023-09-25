<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportStatussRequest;
use App\Http\Requests\UpdateReportStatussRequest;
use App\Http\Resources\Admin\ReportStatussResource;
use App\Models\ReportStatuss;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportStatussesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('report_statuss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReportStatussResource(ReportStatuss::all());
    }

    public function store(StoreReportStatussRequest $request)
    {
        $reportStatuss = ReportStatuss::create($request->all());

        return (new ReportStatussResource($reportStatuss))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ReportStatuss $reportStatuss)
    {
        abort_if(Gate::denies('report_statuss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReportStatussResource($reportStatuss);
    }

    public function update(UpdateReportStatussRequest $request, ReportStatuss $reportStatuss)
    {
        $reportStatuss->update($request->all());

        return (new ReportStatussResource($reportStatuss))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ReportStatuss $reportStatuss)
    {
        abort_if(Gate::denies('report_statuss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportStatuss->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
