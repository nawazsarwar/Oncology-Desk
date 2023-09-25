@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.patient.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.patients.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="registration_date">{{ trans('cruds.patient.fields.registration_date') }}</label>
                            <input class="form-control date" type="text" name="registration_date" id="registration_date" value="{{ old('registration_date') }}">
                            @if($errors->has('registration_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('registration_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.registration_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_mlc_patient" value="0">
                                <input type="checkbox" name="is_mlc_patient" id="is_mlc_patient" value="1" {{ old('is_mlc_patient', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_mlc_patient">{{ trans('cruds.patient.fields.is_mlc_patient') }}</label>
                            </div>
                            @if($errors->has('is_mlc_patient'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_mlc_patient') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.is_mlc_patient_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="uhid_number">{{ trans('cruds.patient.fields.uhid_number') }}</label>
                            <input class="form-control" type="text" name="uhid_number" id="uhid_number" value="{{ old('uhid_number', '') }}">
                            @if($errors->has('uhid_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('uhid_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.uhid_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="abha">{{ trans('cruds.patient.fields.abha') }}</label>
                            <input class="form-control" type="text" name="abha" id="abha" value="{{ old('abha', '') }}">
                            @if($errors->has('abha'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('abha') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.abha_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="mobile_number">{{ trans('cruds.patient.fields.mobile_number') }}</label>
                            <input class="form-control" type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number', '') }}" required>
                            @if($errors->has('mobile_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.mobile_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="salutation_id">{{ trans('cruds.patient.fields.salutation') }}</label>
                            <select class="form-control select2" name="salutation_id" id="salutation_id">
                                @foreach($salutations as $id => $entry)
                                    <option value="{{ $id }}" {{ old('salutation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('salutation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('salutation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.salutation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="first_name">{{ trans('cruds.patient.fields.first_name') }}</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                            @if($errors->has('first_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.first_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">{{ trans('cruds.patient.fields.middle_name') }}</label>
                            <input class="form-control" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                            @if($errors->has('middle_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('middle_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.middle_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ trans('cruds.patient.fields.last_name') }}</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}">
                            @if($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.last_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.patient.fields.gender') }}</label>
                            <select class="form-control" name="gender" id="gender" required>
                                <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Patient::GENDER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gender'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gender') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.gender_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dob">{{ trans('cruds.patient.fields.dob') }}</label>
                            <input class="form-control date" type="text" name="dob" id="dob" value="{{ old('dob') }}">
                            @if($errors->has('dob'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dob') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.dob_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="patient_age_in_years">{{ trans('cruds.patient.fields.patient_age_in_years') }}</label>
                            <input class="form-control" type="number" name="patient_age_in_years" id="patient_age_in_years" value="{{ old('patient_age_in_years', '') }}" step="1" required>
                            @if($errors->has('patient_age_in_years'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('patient_age_in_years') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.patient_age_in_years_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="patient_age_in_months">{{ trans('cruds.patient.fields.patient_age_in_months') }}</label>
                            <input class="form-control" type="number" name="patient_age_in_months" id="patient_age_in_months" value="{{ old('patient_age_in_months', '') }}" step="1">
                            @if($errors->has('patient_age_in_months'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('patient_age_in_months') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.patient_age_in_months_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="patient_age_in_days">{{ trans('cruds.patient.fields.patient_age_in_days') }}</label>
                            <input class="form-control" type="number" name="patient_age_in_days" id="patient_age_in_days" value="{{ old('patient_age_in_days', '') }}" step="1">
                            @if($errors->has('patient_age_in_days'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('patient_age_in_days') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.patient_age_in_days_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="identification_number">{{ trans('cruds.patient.fields.identification_number') }}</label>
                            <input class="form-control" type="text" name="identification_number" id="identification_number" value="{{ old('identification_number', '') }}">
                            @if($errors->has('identification_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('identification_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.identification_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.patient.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', '') }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="postal_code_id">{{ trans('cruds.patient.fields.postal_code') }}</label>
                            <select class="form-control select2" name="postal_code_id" id="postal_code_id">
                                @foreach($postal_codes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('postal_code_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('postal_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('postal_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.postal_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="patient_category_id">{{ trans('cruds.patient.fields.patient_category') }}</label>
                            <select class="form-control select2" name="patient_category_id" id="patient_category_id" required>
                                @foreach($patient_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ old('patient_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('patient_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('patient_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.patient_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.patient.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="province_id">{{ trans('cruds.patient.fields.province') }}</label>
                            <select class="form-control select2" name="province_id" id="province_id">
                                @foreach($provinces as $id => $entry)
                                    <option value="{{ $id }}" {{ old('province_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('province'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('province') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.province_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="district_id">{{ trans('cruds.patient.fields.district') }}</label>
                            <select class="form-control select2" name="district_id" id="district_id">
                                @foreach($districts as $id => $entry)
                                    <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('district'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('district') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="relationship_id">{{ trans('cruds.patient.fields.relationship') }}</label>
                            <select class="form-control select2" name="relationship_id" id="relationship_id">
                                @foreach($relationships as $id => $entry)
                                    <option value="{{ $id }}" {{ old('relationship_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('relationship'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('relationship') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.relationship_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="gurdian_name">{{ trans('cruds.patient.fields.gurdian_name') }}</label>
                            <input class="form-control" type="text" name="gurdian_name" id="gurdian_name" value="{{ old('gurdian_name', '') }}">
                            @if($errors->has('gurdian_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gurdian_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.gurdian_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.patient.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nationality_id">{{ trans('cruds.patient.fields.nationality') }}</label>
                            <select class="form-control select2" name="nationality_id" id="nationality_id">
                                @foreach($nationalities as $id => $entry)
                                    <option value="{{ $id }}" {{ old('nationality_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('nationality'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nationality') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.nationality_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="occupation_id">{{ trans('cruds.patient.fields.occupation') }}</label>
                            <select class="form-control select2" name="occupation_id" id="occupation_id">
                                @foreach($occupations as $id => $entry)
                                    <option value="{{ $id }}" {{ old('occupation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('occupation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('occupation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.occupation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="education_id">{{ trans('cruds.patient.fields.education') }}</label>
                            <select class="form-control select2" name="education_id" id="education_id">
                                @foreach($education as $id => $entry)
                                    <option value="{{ $id }}" {{ old('education_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('education'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('education') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.education_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="yearly_income_id">{{ trans('cruds.patient.fields.yearly_income') }}</label>
                            <select class="form-control select2" name="yearly_income_id" id="yearly_income_id">
                                @foreach($yearly_incomes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('yearly_income_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('yearly_income'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('yearly_income') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.yearly_income_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mlc_number">{{ trans('cruds.patient.fields.mlc_number') }}</label>
                            <input class="form-control" type="text" name="mlc_number" id="mlc_number" value="{{ old('mlc_number', '') }}">
                            @if($errors->has('mlc_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mlc_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.mlc_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="police_station">{{ trans('cruds.patient.fields.police_station') }}</label>
                            <input class="form-control" type="text" name="police_station" id="police_station" value="{{ old('police_station', '') }}">
                            @if($errors->has('police_station'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('police_station') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.police_station_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mlc_remark">{{ trans('cruds.patient.fields.mlc_remark') }}</label>
                            <input class="form-control" type="text" name="mlc_remark" id="mlc_remark" value="{{ old('mlc_remark', '') }}">
                            @if($errors->has('mlc_remark'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mlc_remark') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.mlc_remark_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_referred_patient" value="0">
                                <input type="checkbox" name="is_referred_patient" id="is_referred_patient" value="1" {{ old('is_referred_patient', 0) == 1 ? 'checked' : '' }}>
                                <label for="is_referred_patient">{{ trans('cruds.patient.fields.is_referred_patient') }}</label>
                            </div>
                            @if($errors->has('is_referred_patient'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_referred_patient') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.is_referred_patient_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="referred_by_id">{{ trans('cruds.patient.fields.referred_by') }}</label>
                            <select class="form-control select2" name="referred_by_id" id="referred_by_id">
                                @foreach($referred_bies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('referred_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('referred_by'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('referred_by') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.referred_by_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="referring_hospital">{{ trans('cruds.patient.fields.referring_hospital') }}</label>
                            <input class="form-control" type="text" name="referring_hospital" id="referring_hospital" value="{{ old('referring_hospital', '') }}">
                            @if($errors->has('referring_hospital'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('referring_hospital') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.referring_hospital_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="referring_department">{{ trans('cruds.patient.fields.referring_department') }}</label>
                            <input class="form-control" type="text" name="referring_department" id="referring_department" value="{{ old('referring_department', '') }}">
                            @if($errors->has('referring_department'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('referring_department') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.referring_department_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="reffered_on">{{ trans('cruds.patient.fields.reffered_on') }}</label>
                            <input class="form-control date" type="text" name="reffered_on" id="reffered_on" value="{{ old('reffered_on') }}">
                            @if($errors->has('reffered_on'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reffered_on') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.reffered_on_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="referring_uhid">{{ trans('cruds.patient.fields.referring_uhid') }}</label>
                            <input class="form-control" type="text" name="referring_uhid" id="referring_uhid" value="{{ old('referring_uhid', '') }}">
                            @if($errors->has('referring_uhid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('referring_uhid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.referring_uhid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{ trans('cruds.patient.fields.remarks') }}</label>
                            <textarea class="form-control" name="remarks" id="remarks">{{ old('remarks') }}</textarea>
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.patient.fields.remarks_helper') }}</span>
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