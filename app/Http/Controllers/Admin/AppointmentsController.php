<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Appointment::with(['patient', 'studies', 'priority_level', 'status', 'investigation_performed_by', 'referring_physician', 'added_by'])->select(sprintf('%s.*', (new Appointment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointment_show';
                $editGate      = 'appointment_edit';
                $deleteGate    = 'appointment_delete';
                $crudRoutePart = 'appointments';

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
            $table->addColumn('patient_first_name', function ($row) {
                return $row->patient ? $row->patient->first_name : '';
            });

            $table->editColumn('studies', function ($row) {
                $labels = [];
                foreach ($row->studies as $study) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $study->name);
                }

                return implode(' ', $labels);
            });

            $table->addColumn('priority_level_title', function ($row) {
                return $row->priority_level ? $row->priority_level->title : '';
            });

            $table->addColumn('status_title', function ($row) {
                return $row->status ? $row->status->title : '';
            });

            $table->editColumn('reporting_required', function ($row) {
                return $row->reporting_required ? Appointment::REPORTING_REQUIRED_SELECT[$row->reporting_required] : '';
            });
            $table->editColumn('contrast', function ($row) {
                return $row->contrast ? $row->contrast : '';
            });
            $table->editColumn('films', function ($row) {
                return $row->films ? $row->films : '';
            });
            $table->addColumn('investigation_performed_by_name', function ($row) {
                return $row->investigation_performed_by ? $row->investigation_performed_by->name : '';
            });

            $table->addColumn('added_by_name', function ($row) {
                return $row->added_by ? $row->added_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'patient', 'studies', 'priority_level', 'status', 'investigation_performed_by', 'added_by']);

            return $table->make(true);
        }

        $patients               = Patient::get();
        $studies                = Study::get();
        $priority_levels        = PriorityLevel::get();
        $appointments_statusses = AppointmentsStatuss::get();
        $users                  = User::get();
        $referring_physicians   = ReferringPhysician::get();

        return view('admin.appointments.index', compact('patients', 'studies', 'priority_levels', 'appointments_statusses', 'users', 'referring_physicians'));
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

        return view('admin.appointments.create', compact('added_bies', 'investigation_performed_bies', 'patients', 'priority_levels', 'referring_physicians', 'statuses', 'studies'));
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

        return redirect()->route('admin.appointments.index');
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

        return view('admin.appointments.edit', compact('added_bies', 'appointment', 'investigation_performed_bies', 'patients', 'priority_levels', 'referring_physicians', 'statuses', 'studies'));
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

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('patient', 'studies', 'priority_level', 'status', 'investigation_performed_by', 'referring_physician', 'added_by');

        return view('admin.appointments.show', compact('appointment'));
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
