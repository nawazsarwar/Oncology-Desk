@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.priorityLevel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.priority-levels.update", [$priorityLevel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.priorityLevel.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $priorityLevel->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.priorityLevel.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="turnaround_time">{{ trans('cruds.priorityLevel.fields.turnaround_time') }}</label>
                <input class="form-control {{ $errors->has('turnaround_time') ? 'is-invalid' : '' }}" type="text" name="turnaround_time" id="turnaround_time" value="{{ old('turnaround_time', $priorityLevel->turnaround_time) }}">
                @if($errors->has('turnaround_time'))
                    <span class="text-danger">{{ $errors->first('turnaround_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.priorityLevel.fields.turnaround_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="color">{{ trans('cruds.priorityLevel.fields.color') }}</label>
                <input class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" type="text" name="color" id="color" value="{{ old('color', $priorityLevel->color) }}">
                @if($errors->has('color'))
                    <span class="text-danger">{{ $errors->first('color') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.priorityLevel.fields.color_helper') }}</span>
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