@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="patient_id">{{ trans('cruds.appointment.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                    @foreach($patients as $id => $entry)
                        <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient'))
                    <span class="text-danger">{{ $errors->first('patient') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="studies">{{ trans('cruds.appointment.fields.studies') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('studies') ? 'is-invalid' : '' }}" name="studies[]" id="studies" multiple required>
                    @foreach($studies as $id => $study)
                        <option value="{{ $id }}" {{ in_array($id, old('studies', [])) ? 'selected' : '' }}>{{ $study }}</option>
                    @endforeach
                </select>
                @if($errors->has('studies'))
                    <span class="text-danger">{{ $errors->first('studies') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.studies_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.appointment.fields.start_time') }}</label>
                <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @if($errors->has('start_time'))
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="finish_time">{{ trans('cruds.appointment.fields.finish_time') }}</label>
                <input class="form-control datetime {{ $errors->has('finish_time') ? 'is-invalid' : '' }}" type="text" name="finish_time" id="finish_time" value="{{ old('finish_time') }}" required>
                @if($errors->has('finish_time'))
                    <span class="text-danger">{{ $errors->first('finish_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.finish_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="priority_level_id">{{ trans('cruds.appointment.fields.priority_level') }}</label>
                <select class="form-control select2 {{ $errors->has('priority_level') ? 'is-invalid' : '' }}" name="priority_level_id" id="priority_level_id">
                    @foreach($priority_levels as $id => $entry)
                        <option value="{{ $id }}" {{ old('priority_level_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('priority_level'))
                    <span class="text-danger">{{ $errors->first('priority_level') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.priority_level_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.appointment.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appointment.fields.reporting_required') }}</label>
                <select class="form-control {{ $errors->has('reporting_required') ? 'is-invalid' : '' }}" name="reporting_required" id="reporting_required">
                    <option value disabled {{ old('reporting_required', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Appointment::REPORTING_REQUIRED_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('reporting_required', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('reporting_required'))
                    <span class="text-danger">{{ $errors->first('reporting_required') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.reporting_required_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contrast">{{ trans('cruds.appointment.fields.contrast') }}</label>
                <input class="form-control {{ $errors->has('contrast') ? 'is-invalid' : '' }}" type="number" name="contrast" id="contrast" value="{{ old('contrast', '') }}" step="1">
                @if($errors->has('contrast'))
                    <span class="text-danger">{{ $errors->first('contrast') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.contrast_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="films">{{ trans('cruds.appointment.fields.films') }}</label>
                <input class="form-control {{ $errors->has('films') ? 'is-invalid' : '' }}" type="number" name="films" id="films" value="{{ old('films', '') }}" step="1">
                @if($errors->has('films'))
                    <span class="text-danger">{{ $errors->first('films') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.films_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="investigation_performed_by_id">{{ trans('cruds.appointment.fields.investigation_performed_by') }}</label>
                <select class="form-control select2 {{ $errors->has('investigation_performed_by') ? 'is-invalid' : '' }}" name="investigation_performed_by_id" id="investigation_performed_by_id">
                    @foreach($investigation_performed_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('investigation_performed_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('investigation_performed_by'))
                    <span class="text-danger">{{ $errors->first('investigation_performed_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.investigation_performed_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referring_physician_id">{{ trans('cruds.appointment.fields.referring_physician') }}</label>
                <select class="form-control select2 {{ $errors->has('referring_physician') ? 'is-invalid' : '' }}" name="referring_physician_id" id="referring_physician_id">
                    @foreach($referring_physicians as $id => $entry)
                        <option value="{{ $id }}" {{ old('referring_physician_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('referring_physician'))
                    <span class="text-danger">{{ $errors->first('referring_physician') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.referring_physician_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="history">{{ trans('cruds.appointment.fields.history') }}</label>
                <textarea class="form-control {{ $errors->has('history') ? 'is-invalid' : '' }}" name="history" id="history">{{ old('history') }}</textarea>
                @if($errors->has('history'))
                    <span class="text-danger">{{ $errors->first('history') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.history_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="history_documents">{{ trans('cruds.appointment.fields.history_documents') }}</label>
                <div class="needsclick dropzone {{ $errors->has('history_documents') ? 'is-invalid' : '' }}" id="history_documents-dropzone">
                </div>
                @if($errors->has('history_documents'))
                    <span class="text-danger">{{ $errors->first('history_documents') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.history_documents_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="added_by_id">{{ trans('cruds.appointment.fields.added_by') }}</label>
                <select class="form-control select2 {{ $errors->has('added_by') ? 'is-invalid' : '' }}" name="added_by_id" id="added_by_id" required>
                    @foreach($added_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('added_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('added_by'))
                    <span class="text-danger">{{ $errors->first('added_by') }}</span>
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



@endsection

@section('scripts')
<script>
    var uploadedHistoryDocumentsMap = {}
Dropzone.options.historyDocumentsDropzone = {
    url: '{{ route('admin.appointments.storeMedia') }}',
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