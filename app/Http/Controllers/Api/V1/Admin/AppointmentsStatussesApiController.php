<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentsStatussRequest;
use App\Http\Requests\UpdateAppointmentsStatussRequest;
use App\Http\Resources\Admin\AppointmentsStatussResource;
use App\Models\AppointmentsStatuss;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsStatussesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointments_statuss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentsStatussResource(AppointmentsStatuss::all());
    }

    public function store(StoreAppointmentsStatussRequest $request)
    {
        $appointmentsStatuss = AppointmentsStatuss::create($request->all());

        return (new AppointmentsStatussResource($appointmentsStatuss))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AppointmentsStatuss $appointmentsStatuss)
    {
        abort_if(Gate::denies('appointments_statuss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentsStatussResource($appointmentsStatuss);
    }

    public function update(UpdateAppointmentsStatussRequest $request, AppointmentsStatuss $appointmentsStatuss)
    {
        $appointmentsStatuss->update($request->all());

        return (new AppointmentsStatussResource($appointmentsStatuss))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AppointmentsStatuss $appointmentsStatuss)
    {
        abort_if(Gate::denies('appointments_statuss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsStatuss->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
