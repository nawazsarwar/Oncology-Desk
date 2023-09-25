@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.report.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="appointment_id">{{ trans('cruds.report.fields.appointment') }}</label>
                <select class="form-control select2 {{ $errors->has('appointment') ? 'is-invalid' : '' }}" name="appointment_id" id="appointment_id" required>
                    @foreach($appointments as $id => $entry)
                        <option value="{{ $id }}" {{ old('appointment_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('appointment'))
                    <span class="text-danger">{{ $errors->first('appointment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.appointment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="text">{{ trans('cruds.report.fields.text') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('text') ? 'is-invalid' : '' }}" name="text" id="text">{!! old('text') !!}</textarea>
                @if($errors->has('text'))
                    <span class="text-danger">{{ $errors->first('text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="summary">{{ trans('cruds.report.fields.summary') }}</label>
                <input class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}" type="text" name="summary" id="summary" value="{{ old('summary', '') }}">
                @if($errors->has('summary'))
                    <span class="text-danger">{{ $errors->first('summary') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.summary_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.report.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="template_id">{{ trans('cruds.report.fields.template') }}</label>
                <select class="form-control select2 {{ $errors->has('template') ? 'is-invalid' : '' }}" name="template_id" id="template_id">
                    @foreach($templates as $id => $entry)
                        <option value="{{ $id }}" {{ old('template_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('template'))
                    <span class="text-danger">{{ $errors->first('template') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.template_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.report.fields.special') }}</label>
                @foreach(App\Models\Report::SPECIAL_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('special') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="special_{{ $key }}" name="special" value="{{ $key }}" {{ old('special', 'No') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="special_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('special'))
                    <span class="text-danger">{{ $errors->first('special') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.special_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="evolving">{{ trans('cruds.report.fields.evolving') }}</label>
                <input class="form-control {{ $errors->has('evolving') ? 'is-invalid' : '' }}" type="number" name="evolving" id="evolving" value="{{ old('evolving', '') }}" step="1">
                @if($errors->has('evolving'))
                    <span class="text-danger">{{ $errors->first('evolving') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.evolving_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="allotted_to_id">{{ trans('cruds.report.fields.allotted_to') }}</label>
                <select class="form-control select2 {{ $errors->has('allotted_to') ? 'is-invalid' : '' }}" name="allotted_to_id" id="allotted_to_id">
                    @foreach($allotted_tos as $id => $entry)
                        <option value="{{ $id }}" {{ old('allotted_to_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('allotted_to'))
                    <span class="text-danger">{{ $errors->first('allotted_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.allotted_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="finalized_by_id">{{ trans('cruds.report.fields.finalized_by') }}</label>
                <select class="form-control select2 {{ $errors->has('finalized_by') ? 'is-invalid' : '' }}" name="finalized_by_id" id="finalized_by_id">
                    @foreach($finalized_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('finalized_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('finalized_by'))
                    <span class="text-danger">{{ $errors->first('finalized_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.finalized_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="approved_by_id">{{ trans('cruds.report.fields.approved_by') }}</label>
                <select class="form-control select2 {{ $errors->has('approved_by') ? 'is-invalid' : '' }}" name="approved_by_id" id="approved_by_id">
                    @foreach($approved_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('approved_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('approved_by'))
                    <span class="text-danger">{{ $errors->first('approved_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.approved_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.report.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.report.fields.tags_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.reports.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $report->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection