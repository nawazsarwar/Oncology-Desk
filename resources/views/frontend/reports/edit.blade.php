@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.report.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.reports.update", [$report->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="appointment_id">{{ trans('cruds.report.fields.appointment') }}</label>
                            <select class="form-control select2" name="appointment_id" id="appointment_id" required>
                                @foreach($appointments as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('appointment_id') ? old('appointment_id') : $report->appointment->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('appointment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('appointment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.appointment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="text">{{ trans('cruds.report.fields.text') }}</label>
                            <textarea class="form-control ckeditor" name="text" id="text">{!! old('text', $report->text) !!}</textarea>
                            @if($errors->has('text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.text_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="summary">{{ trans('cruds.report.fields.summary') }}</label>
                            <input class="form-control" type="text" name="summary" id="summary" value="{{ old('summary', $report->summary) }}">
                            @if($errors->has('summary'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('summary') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.summary_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status_id">{{ trans('cruds.report.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id">
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $report->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="template_id">{{ trans('cruds.report.fields.template') }}</label>
                            <select class="form-control select2" name="template_id" id="template_id">
                                @foreach($templates as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('template_id') ? old('template_id') : $report->template->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('template'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('template') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.template_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.report.fields.special') }}</label>
                            @foreach(App\Models\Report::SPECIAL_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="special_{{ $key }}" name="special" value="{{ $key }}" {{ old('special', $report->special) === (string) $key ? 'checked' : '' }}>
                                    <label for="special_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('special'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('special') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.special_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="evolving">{{ trans('cruds.report.fields.evolving') }}</label>
                            <input class="form-control" type="number" name="evolving" id="evolving" value="{{ old('evolving', $report->evolving) }}" step="1">
                            @if($errors->has('evolving'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('evolving') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.evolving_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="allotted_to_id">{{ trans('cruds.report.fields.allotted_to') }}</label>
                            <select class="form-control select2" name="allotted_to_id" id="allotted_to_id">
                                @foreach($allotted_tos as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('allotted_to_id') ? old('allotted_to_id') : $report->allotted_to->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('allotted_to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('allotted_to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.allotted_to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="finalized_by_id">{{ trans('cruds.report.fields.finalized_by') }}</label>
                            <select class="form-control select2" name="finalized_by_id" id="finalized_by_id">
                                @foreach($finalized_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('finalized_by_id') ? old('finalized_by_id') : $report->finalized_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('finalized_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('finalized_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.finalized_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="approved_by_id">{{ trans('cruds.report.fields.approved_by') }}</label>
                            <select class="form-control select2" name="approved_by_id" id="approved_by_id">
                                @foreach($approved_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('approved_by_id') ? old('approved_by_id') : $report->approved_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('approved_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('approved_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.report.fields.approved_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tags">{{ trans('cruds.report.fields.tags') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="tags[]" id="tags" multiple>
                                @foreach($tags as $id => $tag)
                                    <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $report->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tags'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tags') }}
                                </div>
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

        </div>
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
                xhr.open('POST', '{{ route('frontend.reports.storeCKEditorImages') }}', true);
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