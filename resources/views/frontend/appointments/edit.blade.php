@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.appointment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.appointments.update", [$appointment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="patient_id">{{ trans('cruds.appointment.fields.patient') }}</label>
                            <select class="form-control select2" name="patient_id" id="patient_id" required>
                                @foreach($patients as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('patient_id') ? old('patient_id') : $appointment->patient->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('patient'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('patient') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.patient_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="studies">{{ trans('cruds.appointment.fields.studies') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="studies[]" id="studies" multiple required>
                                @foreach($studies as $id => $study)
                                    <option value="{{ $id }}" {{ (in_array($id, old('studies', [])) || $appointment->studies->contains($id)) ? 'selected' : '' }}>{{ $study }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('studies'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('studies') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.studies_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="start_time">{{ trans('cruds.appointment.fields.start_time') }}</label>
                            <input class="form-control datetime" type="text" name="start_time" id="start_time" value="{{ old('start_time', $appointment->start_time) }}" required>
                            @if($errors->has('start_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.start_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="finish_time">{{ trans('cruds.appointment.fields.finish_time') }}</label>
                            <input class="form-control datetime" type="text" name="finish_time" id="finish_time" value="{{ old('finish_time', $appointment->finish_time) }}" required>
                            @if($errors->has('finish_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('finish_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.finish_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="priority_level_id">{{ trans('cruds.appointment.fields.priority_level') }}</label>
                            <select class="form-control select2" name="priority_level_id" id="priority_level_id">
                                @foreach($priority_levels as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('priority_level_id') ? old('priority_level_id') : $appointment->priority_level->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('priority_level'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('priority_level') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.priority_level_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status_id">{{ trans('cruds.appointment.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id">
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $appointment->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.appointment.fields.reporting_required') }}</label>
                            <select class="form-control" name="reporting_required" id="reporting_required">
                                <option value disabled {{ old('reporting_required', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Appointment::REPORTING_REQUIRED_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('reporting_required', $appointment->reporting_required) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('reporting_required'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reporting_required') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.reporting_required_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contrast">{{ trans('cruds.appointment.fields.contrast') }}</label>
                            <input class="form-control" type="number" name="contrast" id="contrast" value="{{ old('contrast', $appointment->contrast) }}" step="1">
                            @if($errors->has('contrast'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contrast') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.contrast_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="films">{{ trans('cruds.appointment.fields.films') }}</label>
                            <input class="form-control" type="number" name="films" id="films" value="{{ old('films', $appointment->films) }}" step="1">
                            @if($errors->has('films'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('films') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.films_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="investigation_performed_by_id">{{ trans('cruds.appointment.fields.investigation_performed_by') }}</label>
                            <select class="form-control select2" name="investigation_performed_by_id" id="investigation_performed_by_id">
                                @foreach($investigation_performed_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('investigation_performed_by_id') ? old('investigation_performed_by_id') : $appointment->investigation_performed_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('investigation_performed_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('investigation_performed_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.investigation_performed_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="referring_physician_id">{{ trans('cruds.appointment.fields.referring_physician') }}</label>
                            <select class="form-control select2" name="referring_physician_id" id="referring_physician_id">
                                @foreach($referring_physicians as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('referring_physician_id') ? old('referring_physician_id') : $appointment->referring_physician->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('referring_physician'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('referring_physician') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.referring_physician_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="history">{{ trans('cruds.appointment.fields.history') }}</label>
                            <textarea class="form-control" name="history" id="history">{{ old('history', $appointment->history) }}</textarea>
                            @if($errors->has('history'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('history') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.history_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="history_documents">{{ trans('cruds.appointment.fields.history_documents') }}</label>
                            <div class="needsclick dropzone" id="history_documents-dropzone">
                            </div>
                            @if($errors->has('history_documents'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('history_documents') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.history_documents_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="added_by_id">{{ trans('cruds.appointment.fields.added_by') }}</label>
                            <select class="form-control select2" name="added_by_id" id="added_by_id" required>
                                @foreach($added_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('added_by_id') ? old('added_by_id') : $appointment->added_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('added_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('added_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.added_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var uploadedHistoryDocumentsMap = {}
Dropzone.options.historyDocumentsDropzone = {
    url: '{{ route('frontend.appointments.storeMedia') }}',
    maxFilesize: 25, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 25
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="history_documents[]" value="' + response.name + '">')
      uploadedHistoryDocumentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedHistoryDocumentsMap[file.name]
      }
      $('form').find('input[name="history_documents[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($appointment) && $appointment->history_documents)
          var files =
            {!! json_encode($appointment->history_documents) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="history_documents[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection