<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReportStatussRequest;
use App\Http\Requests\StoreReportStatussRequest;
use App\Http\Requests\UpdateReportStatussRequest;
use App\Models\ReportStatuss;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportStatussesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('report_statuss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ReportStatuss::query()->select(sprintf('%s.*', (new ReportStatuss)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'report_statuss_show';
                $editGate      = 'report_statuss_edit';
                $deleteGate    = 'report_statuss_delete';
                $crudRoutePart = 'report-statusses';

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
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.reportStatusses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('report_statuss_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportStatusses.create');
    }

    public function store(StoreReportStatussRequest $request)
    {
        $reportStatuss = ReportStatuss::create($request->all());

        return redirect()->route('admin.report-statusses.index');
    }

    public function edit(ReportStatuss $reportStatuss)
    {
        abort_if(Gate::denies('report_statuss_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportStatusses.edit', compact('reportStatuss'));
    }

    public function update(UpdateReportStatussRequest $request, ReportStatuss $reportStatuss)
    {
        $reportStatuss->update($request->all());

        return redirect()->route('admin.report-statusses.index');
    }

    public function show(ReportStatuss $reportStatuss)
    {
        abort_if(Gate::denies('report_statuss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportStatusses.show', compact('reportStatuss'));
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
