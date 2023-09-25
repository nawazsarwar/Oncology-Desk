<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentsTypeRequest;
use App\Http\Requests\UpdateAppointmentsTypeRequest;
use App\Http\Resources\Admin\AppointmentsTypeResource;
use App\Models\AppointmentsType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointments_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentsTypeResource(AppointmentsType::all());
    }

    public function store(StoreAppointmentsTypeRequest $request)
    {
        $appointmentsType = AppointmentsType::create($request->all());

        return (new AppointmentsTypeResource($appointmentsType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AppointmentsType $appointmentsType)
    {
        abort_if(Gate::denies('appointments_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentsTypeResource($appointmentsType);
    }

    public function update(UpdateAppointmentsTypeRequest $request, AppointmentsType $appointmentsType)
    {
        $appointmentsType->update($request->all());

        return (new AppointmentsTypeResource($appointmentsType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AppointmentsType $appointmentsType)
    {
        abort_if(Gate::denies('appointments_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
