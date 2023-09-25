@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.country.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.countries.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.country.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="code">{{ trans('cruds.country.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="dialing_code">{{ trans('cruds.country.fields.dialing_code') }}</label>
                            <input class="form-control" type="text" name="dialing_code" id="dialing_code" value="{{ old('dialing_code', '') }}" required>
                            @if($errors->has('dialing_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dialing_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.dialing_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nationality">{{ trans('cruds.country.fields.nationality') }}</label>
                            <input class="form-control" type="text" name="nationality" id="nationality" value="{{ old('nationality', '') }}">
                            @if($errors->has('nationality'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nationality') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.nationality_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sequence">{{ trans('cruds.country.fields.sequence') }}</label>
                            <input class="form-control" type="text" name="sequence" id="sequence" value="{{ old('sequence', '') }}">
                            @if($errors->has('sequence'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sequence') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.sequence_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.country.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.country.fields.remarks') }}</label>
                            <textarea class="form-control" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.country.fields.remarks_helper') }}</span>
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