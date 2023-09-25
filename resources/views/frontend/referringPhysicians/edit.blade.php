@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.referringPhysician.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.referring-physicians.update", [$referringPhysician->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.referringPhysician.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $referringPhysician->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.referringPhysician.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.referringPhysician.fields.gender') }}</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\ReferringPhysician::GENDER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('gender', $referringPhysician->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gender'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gender') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.referringPhysician.fields.gender_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mobile_no">{{ trans('cruds.referringPhysician.fields.mobile_no') }}</label>
                            <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', $referringPhysician->mobile_no) }}">
                            @if($errors->has('mobile_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.referringPhysician.fields.mobile_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.referringPhysician.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $referringPhysician->email) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.referringPhysician.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="department">{{ trans('cruds.referringPhysician.fields.department') }}</label>
                            <input class="form-control" type="text" name="department" id="department" value="{{ old('department', $referringPhysician->department) }}">
                            @if($errors->has('department'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('department') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.referringPhysician.fields.department_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.referringPhysician.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $referringPhysician->address) }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.referringPhysician.fields.address_helper') }}</span>
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