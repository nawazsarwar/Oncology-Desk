<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppointmentsTypeRequest;
use App\Http\Requests\StoreAppointmentsTypeRequest;
use App\Http\Requests\UpdateAppointmentsTypeRequest;
use App\Models\AppointmentsType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsTypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('appointments_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsTypes = AppointmentsType::all();

        return view('frontend.appointmentsTypes.index', compact('appointmentsTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointments_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentsTypes.create');
    }

    public function store(StoreAppointmentsTypeRequest $request)
    {
        $appointmentsType = AppointmentsType::create($request->all());

        return redirect()->route('frontend.appointments-types.index');
    }

    public function edit(AppointmentsType $appointmentsType)
    {
        abort_if(Gate::denies('appointments_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentsTypes.edit', compact('appointmentsType'));
    }

    public function update(UpdateAppointmentsTypeRequest $request, AppointmentsType $appointmentsType)
    {
        $appointmentsType->update($request->all());

        return redirect()->route('frontend.appointments-types.index');
    }

    public function show(AppointmentsType $appointmentsType)
    {
        abort_if(Gate::denies('appointments_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentsTypes.show', compact('appointmentsType'));
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
