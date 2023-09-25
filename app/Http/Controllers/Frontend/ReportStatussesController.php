<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReportStatussRequest;
use App\Http\Requests\StoreReportStatussRequest;
use App\Http\Requests\UpdateReportStatussRequest;
use App\Models\ReportStatuss;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportStatussesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('report_statuss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportStatusses = ReportStatuss::all();

        return view('frontend.reportStatusses.index', compact('reportStatusses'));
    }

    public function create()
    {
        abort_if(Gate::denies('report_statuss_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.reportStatusses.create');
    }

    public function store(StoreReportStatussRequest $request)
    {
        $reportStatuss = ReportStatuss::create($request->all());

        return redirect()->route('frontend.report-statusses.index');
    }

    public function edit(ReportStatuss $reportStatuss)
    {
        abort_if(Gate::denies('report_statuss_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.reportStatusses.edit', compact('reportStatuss'));
    }

    public function update(UpdateReportStatussRequest $request, ReportStatuss $reportStatuss)
    {
        $reportStatuss->update($request->all());

        return redirect()->route('frontend.report-statusses.index');
    }

    public function show(ReportStatuss $reportStatuss)
    {
        abort_if(Gate::denies('report_statuss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.reportStatusses.show', compact('reportStatuss'));
    }

    public function destroy(ReportStatuss $reportStatuss)
    {
        abort_if(Gate::denies('report_statuss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportStatuss->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportStatussRequest $request)
    {
        $reportStatusses = ReportStatuss::find(request('ids'));

        foreach ($reportStatusses as $reportStatuss) {
            $reportStatuss->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
