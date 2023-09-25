@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.comment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="body">{{ trans('cruds.comment.fields.body') }}</label>
                <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body">{{ old('body') }}</textarea>
                @if($errors->has('body'))
                    <span class="text-danger">{{ $errors->first('body') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.body_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachment">{{ trans('cruds.comment.fields.attachment') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                </div>
                @if($errors->has('attachment'))
                    <span class="text-danger">{{ $errors->first('attachment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.attachment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="commentable_id">{{ trans('cruds.comment.fields.commentable') }}</label>
                <select class="form-control select2 {{ $errors->has('commentable') ? 'is-invalid' : '' }}" name="commentable_id" id="commentable_id" required>
                    @foreach($commentables as $id => $entry)
                        <option value="{{ $id }}" {{ old('commentable_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('commentable'))
                    <span class="text-danger">{{ $errors->first('commentable') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.commentable_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="commentable_type">{{ trans('cruds.comment.fields.commentable_type') }}</label>
                <input class="form-control {{ $errors->has('commentable_type') ? 'is-invalid' : '' }}" type="text" name="commentable_type" id="commentable_type" value="{{ old('commentable_type', '') }}" required>
                @if($errors->has('commentable_type'))
                    <span class="text-danger">{{ $errors->first('commentable_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.commentable_type_helper') }}</span>
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
    Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.comments.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').find('input[name="attachment"]').remove()
      $('form').append('<input type="hidden" name="attachment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="attachment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($comment) && $comment->attachment)
      var file = {!! json_encode($comment->attachment) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="attachment" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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