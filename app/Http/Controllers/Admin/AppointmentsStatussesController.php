<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppointmentsStatussRequest;
use App\Http\Requests\StoreAppointmentsStatussRequest;
use App\Http\Requests\UpdateAppointmentsStatussRequest;
use App\Models\AppointmentsStatuss;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsStatussesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('appointments_statuss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AppointmentsStatuss::query()->select(sprintf('%s.*', (new AppointmentsStatuss)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointments_statuss_show';
                $editGate      = 'appointments_statuss_edit';
                $deleteGate    = 'appointments_statuss_delete';
                $crudRoutePart = 'appointments-statusses';

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

        return view('admin.appointmentsStatusses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appointments_statuss_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentsStatusses.create');
    }

    public function store(StoreAppointmentsStatussRequest $request)
    {
        $appointmentsStatuss = AppointmentsStatuss::create($request->all());

        return redirect()->route('admin.appointments-statusses.index');
    }

    public function edit(AppointmentsStatuss $appointmentsStatuss)
    {
        abort_if(Gate::denies('appointments_statuss_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentsStatusses.edit', compact('appointmentsStatuss'));
    }

    public function update(UpdateAppointmentsStatussRequest $request, AppointmentsStatuss $appointmentsStatuss)
    {
        $appointmentsStatuss->update($request->all());

        return redirect()->route('admin.appointments-statusses.index');
    }

    public function show(AppointmentsStatuss $appointmentsStatuss)
    {
        abort_if(Gate::denies('appointments_statuss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentsStatusses.show', compact('appointmentsStatuss'));
    }

    public function destroy(AppointmentsStatuss $appointmentsStatuss)
    {
        abort_if(Gate::denies('appointments_statuss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsStatuss->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentsStatussRequest $request)
    {
        $appointmentsStatusses = AppointmentsStatuss::find(request('ids'));

        foreach ($appointmentsStatusses as $appointmentsStatuss) {
            $appointmentsStatuss->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
