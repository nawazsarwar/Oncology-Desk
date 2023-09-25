@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.study.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.studies.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="modality_id">{{ trans('cruds.study.fields.modality') }}</label>
                            <select class="form-control select2" name="modality_id" id="modality_id" required>
                                @foreach($modalities as $id => $entry)
                                    <option value="{{ $id }}" {{ old('modality_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('modality'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('modality') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.modality_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="type">{{ trans('cruds.study.fields.type') }}</label>
                            <input class="form-control" type="text" name="type" id="type" value="{{ old('type', '') }}" required>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.study.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="fee">{{ trans('cruds.study.fields.fee') }}</label>
                            <input class="form-control" type="number" name="fee" id="fee" value="{{ old('fee', '') }}" step="0.01" required>
                            @if($errors->has('fee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.fee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="maximum_slots">{{ trans('cruds.study.fields.maximum_slots') }}</label>
                            <input class="form-control" type="number" name="maximum_slots" id="maximum_slots" value="{{ old('maximum_slots', '') }}" step="1" required>
                            @if($errors->has('maximum_slots'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('maximum_slots') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.maximum_slots_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="time_per_slot">{{ trans('cruds.study.fields.time_per_slot') }}</label>
                            <input class="form-control" type="number" name="time_per_slot" id="time_per_slot" value="{{ old('time_per_slot', '') }}" step="1" required>
                            @if($errors->has('time_per_slot'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('time_per_slot') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.time_per_slot_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="films">{{ trans('cruds.study.fields.films') }}</label>
                            <input class="form-control" type="number" name="films" id="films" value="{{ old('films', '') }}" step="1">
                            @if($errors->has('films'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('films') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.films_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="weightage">{{ trans('cruds.study.fields.weightage') }}</label>
                            <input class="form-control" type="number" name="weightage" id="weightage" value="{{ old('weightage', '') }}" step="1">
                            @if($errors->has('weightage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weightage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.weightage_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="facility_id">{{ trans('cruds.study.fields.facility') }}</label>
                            <select class="form-control select2" name="facility_id" id="facility_id" required>
                                @foreach($facilities as $id => $entry)
                                    <option value="{{ $id }}" {{ old('facility_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('facility'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('facility') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.facility_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.study.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Study::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', 'Active') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.study.fields.remarks') }}</label>
                            <textarea class="form-control" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.study.fields.remarks_helper') }}</span>
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