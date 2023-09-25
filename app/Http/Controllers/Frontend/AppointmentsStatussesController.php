<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppointmentsStatussRequest;
use App\Http\Requests\StoreAppointmentsStatussRequest;
use App\Http\Requests\UpdateAppointmentsStatussRequest;
use App\Models\AppointmentsStatuss;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsStatussesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('appointments_statuss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsStatusses = AppointmentsStatuss::all();

        return view('frontend.appointmentsStatusses.index', compact('appointmentsStatusses'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointments_statuss_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentsStatusses.create');
    }

    public function store(StoreAppointmentsStatussRequest $request)
    {
        $appointmentsStatuss = AppointmentsStatuss::create($request->all());

        return redirect()->route('frontend.appointments-statusses.index');
    }

    public function edit(AppointmentsStatuss $appointmentsStatuss)
    {
        abort_if(Gate::denies('appointments_statuss_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentsStatusses.edit', compact('appointmentsStatuss'));
    }

    public function update(UpdateAppointmentsStatussRequest $request, AppointmentsStatuss $appointmentsStatuss)
    {
        $appointmentsStatuss->update($request->all());

        return redirect()->route('frontend.appointments-statusses.index');
    }

    public function show(AppointmentsStatuss $appointmentsStatuss)
    {
        abort_if(Gate::denies('appointments_statuss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentsStatusses.show', compact('appointmentsStatuss'));
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
