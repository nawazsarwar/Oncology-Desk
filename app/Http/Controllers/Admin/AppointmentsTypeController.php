<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppointmentsTypeRequest;
use App\Http\Requests\StoreAppointmentsTypeRequest;
use App\Http\Requests\UpdateAppointmentsTypeRequest;
use App\Models\AppointmentsType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('appointments_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AppointmentsType::query()->select(sprintf('%s.*', (new AppointmentsType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointments_type_show';
                $editGate      = 'appointments_type_edit';
                $deleteGate    = 'appointments_type_delete';
                $crudRoutePart = 'appointments-types';

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

        return view('admin.appointmentsTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appointments_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentsTypes.create');
    }

    public function store(StoreAppointmentsTypeRequest $request)
    {
        $appointmentsType = AppointmentsType::create($request->all());

        return redirect()->route('admin.appointments-types.index');
    }

    public function edit(AppointmentsType $appointmentsType)
    {
        abort_if(Gate::denies('appointments_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentsTypes.edit', compact('appointmentsType'));
    }

    public function update(UpdateAppointmentsTypeRequest $request, AppointmentsType $appointmentsType)
    {
        $appointmentsType->update($request->all());

        return redirect()->route('admin.appointments-types.index');
    }

    public function show(AppointmentsType $appointmentsType)
    {
        abort_if(Gate::denies('appointments_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentsTypes.show', compact('appointmentsType'));
    }

    public function destroy(AppointmentsType $appointmentsType)
    {
        abort_if(Gate::denies('appointments_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsType->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentsTypeRequest $request)
    {
        $appointmentsTypes = AppointmentsType::find(request('ids'));

        foreach ($appointmentsTypes as $appointmentsType) {
            $appointmentsType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
