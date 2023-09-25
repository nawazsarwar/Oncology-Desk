@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.province.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.provinces.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="country_id">{{ trans('cruds.province.fields.country') }}</label>
                            <select class="form-control select2" name="country_id" id="country_id">
                                @foreach($countries as $id => $entry)
                                    <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.province.fields.type') }}</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Province::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.province.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="iso_3166_2_in">{{ trans('cruds.province.fields.iso_3166_2_in') }}</label>
                            <input class="form-control" type="text" name="iso_3166_2_in" id="iso_3166_2_in" value="{{ old('iso_3166_2_in', '') }}">
                            @if($errors->has('iso_3166_2_in'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('iso_3166_2_in') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.iso_3166_2_in_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="vehicle_code">{{ trans('cruds.province.fields.vehicle_code') }}</label>
                            <input class="form-control" type="text" name="vehicle_code" id="vehicle_code" value="{{ old('vehicle_code', '') }}">
                            @if($errors->has('vehicle_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vehicle_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.vehicle_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="zone">{{ trans('cruds.province.fields.zone') }}</label>
                            <input class="form-control" type="text" name="zone" id="zone" value="{{ old('zone', '') }}">
                            @if($errors->has('zone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('zone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.zone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="capital">{{ trans('cruds.province.fields.capital') }}</label>
                            <input class="form-control" type="text" name="capital" id="capital" value="{{ old('capital', '') }}">
                            @if($errors->has('capital'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('capital') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.capital_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="largest_city">{{ trans('cruds.province.fields.largest_city') }}</label>
                            <input class="form-control" type="text" name="largest_city" id="largest_city" value="{{ old('largest_city', '') }}">
                            @if($errors->has('largest_city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('largest_city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.largest_city_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="statehood">{{ trans('cruds.province.fields.statehood') }}</label>
                            <input class="form-control" type="number" name="statehood" id="statehood" value="{{ old('statehood', '') }}" step="1">
                            @if($errors->has('statehood'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('statehood') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.statehood_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="population">{{ trans('cruds.province.fields.population') }}</label>
                            <input class="form-control" type="text" name="population" id="population" value="{{ old('population', '') }}">
                            @if($errors->has('population'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('population') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.population_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="area">{{ trans('cruds.province.fields.area') }}</label>
                            <input class="form-control" type="text" name="area" id="area" value="{{ old('area', '') }}">
                            @if($errors->has('area'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('area') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.area_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="official_languages">{{ trans('cruds.province.fields.official_languages') }}</label>
                            <input class="form-control" type="text" name="official_languages" id="official_languages" value="{{ old('official_languages', '') }}">
                            @if($errors->has('official_languages'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('official_languages') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.official_languages_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="additional_official_languages">{{ trans('cruds.province.fields.additional_official_languages') }}</label>
                            <input class="form-control" type="text" name="additional_official_languages" id="additional_official_languages" value="{{ old('additional_official_languages', '') }}">
                            @if($errors->has('additional_official_languages'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('additional_official_languages') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.additional_official_languages_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.province.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.province.fields.remarks') }}</label>
                            <textarea class="form-control" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.province.fields.remarks_helper') }}</span>
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