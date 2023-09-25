@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.priorityLevel.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.priority-levels.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.priorityLevel.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priorityLevel.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="turnaround_time">{{ trans('cruds.priorityLevel.fields.turnaround_time') }}</label>
                            <input class="form-control" type="text" name="turnaround_time" id="turnaround_time" value="{{ old('turnaround_time', '') }}">
                            @if($errors->has('turnaround_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('turnaround_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.priorityLevel.fields.turnaround_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="color">{{ trans('cruds.priorityLevel.fields.color') }}</label>
                            <input class="form-control" type="text" name="color" id="color" value="{{ old('color', '') }}">
                            @if($errors->has('color'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('color') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection