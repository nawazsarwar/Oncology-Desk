<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\Admin\AppointmentResource;
use App\Models\Appointment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentResource(Appointment::with(['patient', 'studies', 'priority_level', 'status', 'investigation_performed_by', 'referring_physician', 'added_by'])->get());
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());
        $appointment->studies()->sync($request->input('studies', []));
        foreach ($request->input('history_documents', []) as $file) {
            $appointment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('history_documents');
        }

        return (new AppointmentResource($appointment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentResource($appointment->load(['patient', 'studies', 'priority_level', 'status', 'investigation_performed_by', 'referring_physician', 'added_by']));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());
        $appointment->studies()->sync($request->input('studies', []));
        if (count($appointment->history_documents) > 0) {
            foreach ($appointment->history_documents as $media) {
                if (! in_array($media->file_name, $request->input('history_documents', []))) {
                    $media->delete();
                }
            }
        }
        $media = $appointment->history_documents->pluck('file_name')->toArray();
        foreach ($request->input('history_documents', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $appointment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('history_documents');
            }
        }

        return (new AppointmentResource($appointment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
