<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentsStatuss;
use App\Models\Patient;
use App\Models\PriorityLevel;
use App\Models\ReferringPhysician;
use App\Models\Study;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::with(['patient', 'studies', 'priority_level', 'status', 'investigation_performed_by', 'referring_physician', 'added_by', 'media'])->get();

        $patients = Patient::get();

        $studies = Study::get();

        $priority_levels = PriorityLevel::get();

        $appointments_statusses = AppointmentsStatuss::get();

        $users = User::get();

        $referring_physicians = ReferringPhysician::get();

        return view('frontend.appointments.index', compact('appointments', 'appointments_statusses', 'patients', 'priority_levels', 'referring_physicians', 'studies', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studies = Study::pluck('name', 'id');

        $priority_levels = PriorityLevel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = AppointmentsStatuss::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $investigation_performed_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $referring_physicians = ReferringPhysician::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $added_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.appointments.create', compact('added_bies', 'investigation_performed_bies', 'patients', 'priority_levels', 'referring_physicians', 'statuses', 'studies'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());
        $appointment->studies()->sync($request->input('studies', []));
        foreach ($request->input('history_documents', []) as $file) {
            $appointment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('history_documents');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $appointment->id]);
        }

        return redirect()->route('frontend.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studies = Study::pluck('name', 'id');

        $priority_levels = PriorityLevel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = AppointmentsStatuss::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $investigation_performed_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $referring_physicians = ReferringPhysician::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $added_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('patient', 'studies', 'priority_level', 'status', 'investigation_performed_by', 'referring_physician', 'added_by');

        return view('frontend.appointments.edit', compact('added_bies', 'appointment', 'investigation_performed_bies', 'patients', 'priority_levels', 'referring_physicians', 'statuses', 'studies'));
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

        return redirect()->route('frontend.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('patient', 'studies', 'priority_level', 'status', 'investigation_performed_by', 'referring_physician', 'added_by');

        return view('frontend.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        $appointments = Appointment::find(request('ids'));

        foreach ($appointments as $appointment) {
            $appointment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('appointment_create') && Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Appointment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
