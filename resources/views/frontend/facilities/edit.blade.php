@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.facility.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.facilities.update", [$facility->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.facility.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $facility->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.facility.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="location">{{ trans('cruds.facility.fields.location') }}</label>
                            <input class="form-control" type="text" name="location" id="location" value="{{ old('location', $facility->location) }}" required>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.facility.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.facility.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $facility->address) }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.facility.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone_no">{{ trans('cruds.facility.fields.phone_no') }}</label>
                            <input class="form-control" type="text" name="phone_no" id="phone_no" value="{{ old('phone_no', $facility->phone_no) }}">
                            @if($errors->has('phone_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.facility.fields.phone_no_helper') }}</span>
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