@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.patient.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.patients.update", [$patient->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="registration_date">{{ trans('cruds.patient.fields.registration_date') }}</label>
                <input class="form-control date {{ $errors->has('registration_date') ? 'is-invalid' : '' }}" type="text" name="registration_date" id="registration_date" value="{{ old('registration_date', $patient->registration_date) }}">
                @if($errors->has('registration_date'))
                    <span class="text-danger">{{ $errors->first('registration_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.registration_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_mlc_patient') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_mlc_patient" value="0">
                    <input class="form-check-input" type="checkbox" name="is_mlc_patient" id="is_mlc_patient" value="1" {{ $patient->is_mlc_patient || old('is_mlc_patient', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_mlc_patient">{{ trans('cruds.patient.fields.is_mlc_patient') }}</label>
                </div>
                @if($errors->has('is_mlc_patient'))
                    <span class="text-danger">{{ $errors->first('is_mlc_patient') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.is_mlc_patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="uhid_number">{{ trans('cruds.patient.fields.uhid_number') }}</label>
                <input class="form-control {{ $errors->has('uhid_number') ? 'is-invalid' : '' }}" type="text" name="uhid_number" id="uhid_number" value="{{ old('uhid_number', $patient->uhid_number) }}">
                @if($errors->has('uhid_number'))
                    <span class="text-danger">{{ $errors->first('uhid_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.uhid_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="abha">{{ trans('cruds.patient.fields.abha') }}</label>
                <input class="form-control {{ $errors->has('abha') ? 'is-invalid' : '' }}" type="text" name="abha" id="abha" value="{{ old('abha', $patient->abha) }}">
                @if($errors->has('abha'))
                    <span class="text-danger">{{ $errors->first('abha') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.abha_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mobile_number">{{ trans('cruds.patient.fields.mobile_number') }}</label>
                <input class="form-control {{ $errors->has('mobile_number') ? 'is-invalid' : '' }}" type="text" name="mobile_number" id="mobile_number" value="{{ old('mobile_number', $patient->mobile_number) }}" required>
                @if($errors->has('mobile_number'))
                    <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.mobile_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="salutation_id">{{ trans('cruds.patient.fields.salutation') }}</label>
                <select class="form-control select2 {{ $errors->has('salutation') ? 'is-invalid' : '' }}" name="salutation_id" id="salutation_id">
                    @foreach($salutations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('salutation_id') ? old('salutation_id') : $patient->salutation->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('salutation'))
                    <span class="text-danger">{{ $errors->first('salutation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.salutation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.patient.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $patient->first_name) }}" required>
                @if($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.patient.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $patient->middle_name) }}">
                @if($errors->has('middle_name'))
                    <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('cruds.patient.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $patient->last_name) }}">
                @if($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.patient.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Patient::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', $patient->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="dob">{{ trans('cruds.patient.fields.dob') }}</label>
                <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob', $patient->dob) }}">
                @if($errors->has('dob'))
                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.dob_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="patient_age_in_years">{{ trans('cruds.patient.fields.patient_age_in_years') }}</label>
                <input class="form-control {{ $errors->has('patient_age_in_years') ? 'is-invalid' : '' }}" type="number" name="patient_age_in_years" id="patient_age_in_years" value="{{ old('patient_age_in_years', $patient->patient_age_in_years) }}" step="1" required>
                @if($errors->has('patient_age_in_years'))
                    <span class="text-danger">{{ $errors->first('patient_age_in_years') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.patient_age_in_years_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="patient_age_in_months">{{ trans('cruds.patient.fields.patient_age_in_months') }}</label>
                <input class="form-control {{ $errors->has('patient_age_in_months') ? 'is-invalid' : '' }}" type="number" name="patient_age_in_months" id="patient_age_in_months" value="{{ old('patient_age_in_months', $patient->patient_age_in_months) }}" step="1">
                @if($errors->has('patient_age_in_months'))
                    <span class="text-danger">{{ $errors->first('patient_age_in_months') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.patient_age_in_months_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="patient_age_in_days">{{ trans('cruds.patient.fields.patient_age_in_days') }}</label>
                <input class="form-control {{ $errors->has('patient_age_in_days') ? 'is-invalid' : '' }}" type="number" name="patient_age_in_days" id="patient_age_in_days" value="{{ old('patient_age_in_days', $patient->patient_age_in_days) }}" step="1">
                @if($errors->has('patient_age_in_days'))
                    <span class="text-danger">{{ $errors->first('patient_age_in_days') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.patient_age_in_days_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="identification_number">{{ trans('cruds.patient.fields.identification_number') }}</label>
                <input class="form-control {{ $errors->has('identification_number') ? 'is-invalid' : '' }}" type="text" name="identification_number" id="identification_number" value="{{ old('identification_number', $patient->identification_number) }}">
                @if($errors->has('identification_number'))
                    <span class="text-danger">{{ $errors->first('identification_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.identification_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.patient.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $patient->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="postal_code_id">{{ trans('cruds.patient.fields.postal_code') }}</label>
                <select class="form-control select2 {{ $errors->has('postal_code') ? 'is-invalid' : '' }}" name="postal_code_id" id="postal_code_id">
                    @foreach($postal_codes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('postal_code_id') ? old('postal_code_id') : $patient->postal_code->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('postal_code'))
                    <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.postal_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="patient_category_id">{{ trans('cruds.patient.fields.patient_category') }}</label>
                <select class="form-control select2 {{ $errors->has('patient_category') ? 'is-invalid' : '' }}" name="patient_category_id" id="patient_category_id" required>
                    @foreach($patient_categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('patient_category_id') ? old('patient_category_id') : $patient->patient_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('patient_category'))
                    <span class="text-danger">{{ $errors->first('patient_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.patient_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.patient.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $patient->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="province_id">{{ trans('cruds.patient.fields.province') }}</label>
                <select class="form-control select2 {{ $errors->has('province') ? 'is-invalid' : '' }}" name="province_id" id="province_id">
                    @foreach($provinces as $id => $entry)
                        <option value="{{ $id }}" {{ (old('province_id') ? old('province_id') : $patient->province->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('province'))
                    <span class="text-danger">{{ $errors->first('province') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.province_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="district_id">{{ trans('cruds.patient.fields.district') }}</label>
                <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id">
                    @foreach($districts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $patient->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('district'))
                    <span class="text-danger">{{ $errors->first('district') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.district_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="relationship_id">{{ trans('cruds.patient.fields.relationship') }}</label>
                <select class="form-control select2 {{ $errors->has('relationship') ? 'is-invalid' : '' }}" name="relationship_id" id="relationship_id">
                    @foreach($relationships as $id => $entry)
                        <option value="{{ $id }}" {{ (old('relationship_id') ? old('relationship_id') : $patient->relationship->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('relationship'))
                    <span class="text-danger">{{ $errors->first('relationship') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.relationship_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gurdian_name">{{ trans('cruds.patient.fields.gurdian_name') }}</label>
                <input class="form-control {{ $errors->has('gurdian_name') ? 'is-invalid' : '' }}" type="text" name="gurdian_name" id="gurdian_name" value="{{ old('gurdian_name', $patient->gurdian_name) }}">
                @if($errors->has('gurdian_name'))
                    <span class="text-danger">{{ $errors->first('gurdian_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.gurdian_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.patient.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $patient->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nationality_id">{{ trans('cruds.patient.fields.nationality') }}</label>
                <select class="form-control select2 {{ $errors->has('nationality') ? 'is-invalid' : '' }}" name="nationality_id" id="nationality_id">
                    @foreach($nationalities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('nationality_id') ? old('nationality_id') : $patient->nationality->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nationality'))
                    <span class="text-danger">{{ $errors->first('nationality') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.nationality_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="occupation_id">{{ trans('cruds.patient.fields.occupation') }}</label>
                <select class="form-control select2 {{ $errors->has('occupation') ? 'is-invalid' : '' }}" name="occupation_id" id="occupation_id">
                    @foreach($occupations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('occupation_id') ? old('occupation_id') : $patient->occupation->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('occupation'))
                    <span class="text-danger">{{ $errors->first('occupation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.occupation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="education_id">{{ trans('cruds.patient.fields.education') }}</label>
                <select class="form-control select2 {{ $errors->has('education') ? 'is-invalid' : '' }}" name="education_id" id="education_id">
                    @foreach($education as $id => $entry)
                        <option value="{{ $id }}" {{ (old('education_id') ? old('education_id') : $patient->education->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('education'))
                    <span class="text-danger">{{ $errors->first('education') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.education_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="yearly_income_id">{{ trans('cruds.patient.fields.yearly_income') }}</label>
                <select class="form-control select2 {{ $errors->has('yearly_income') ? 'is-invalid' : '' }}" name="yearly_income_id" id="yearly_income_id">
                    @foreach($yearly_incomes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('yearly_income_id') ? old('yearly_income_id') : $patient->yearly_income->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('yearly_income'))
                    <span class="text-danger">{{ $errors->first('yearly_income') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.yearly_income_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mlc_number">{{ trans('cruds.patient.fields.mlc_number') }}</label>
                <input class="form-control {{ $errors->has('mlc_number') ? 'is-invalid' : '' }}" type="text" name="mlc_number" id="mlc_number" value="{{ old('mlc_number', $patient->mlc_number) }}">
                @if($errors->has('mlc_number'))
                    <span class="text-danger">{{ $errors->first('mlc_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.mlc_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="police_station">{{ trans('cruds.patient.fields.police_station') }}</label>
                <input class="form-control {{ $errors->has('police_station') ? 'is-invalid' : '' }}" type="text" name="police_station" id="police_station" value="{{ old('police_station', $patient->police_station) }}">
                @if($errors->has('police_station'))
                    <span class="text-danger">{{ $errors->first('police_station') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.police_station_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mlc_remark">{{ trans('cruds.patient.fields.mlc_remark') }}</label>
                <input class="form-control {{ $errors->has('mlc_remark') ? 'is-invalid' : '' }}" type="text" name="mlc_remark" id="mlc_remark" value="{{ old('mlc_remark', $patient->mlc_remark) }}">
                @if($errors->has('mlc_remark'))
                    <span class="text-danger">{{ $errors->first('mlc_remark') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.mlc_remark_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_referred_patient') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_referred_patient" value="0">
                    <input class="form-check-input" type="checkbox" name="is_referred_patient" id="is_referred_patient" value="1" {{ $patient->is_referred_patient || old('is_referred_patient', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_referred_patient">{{ trans('cruds.patient.fields.is_referred_patient') }}</label>
                </div>
                @if($errors->has('is_referred_patient'))
                    <span class="text-danger">{{ $errors->first('is_referred_patient') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.is_referred_patient_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referred_by_id">{{ trans('cruds.patient.fields.referred_by') }}</label>
                <select class="form-control select2 {{ $errors->has('referred_by') ? 'is-invalid' : '' }}" name="referred_by_id" id="referred_by_id">
                    @foreach($referred_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('referred_by_id') ? old('referred_by_id') : $patient->referred_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('referred_by'))
                    <span class="text-danger">{{ $errors->first('referred_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.referred_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referring_hospital">{{ trans('cruds.patient.fields.referring_hospital') }}</label>
                <input class="form-control {{ $errors->has('referring_hospital') ? 'is-invalid' : '' }}" type="text" name="referring_hospital" id="referring_hospital" value="{{ old('referring_hospital', $patient->referring_hospital) }}">
                @if($errors->has('referring_hospital'))
                    <span class="text-danger">{{ $errors->first('referring_hospital') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.referring_hospital_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referring_department">{{ trans('cruds.patient.fields.referring_department') }}</label>
                <input class="form-control {{ $errors->has('referring_department') ? 'is-invalid' : '' }}" type="text" name="referring_department" id="referring_department" value="{{ old('referring_department', $patient->referring_department) }}">
                @if($errors->has('referring_department'))
                    <span class="text-danger">{{ $errors->first('referring_department') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.referring_department_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reffered_on">{{ trans('cruds.patient.fields.reffered_on') }}</label>
                <input class="form-control date {{ $errors->has('reffered_on') ? 'is-invalid' : '' }}" type="text" name="reffered_on" id="reffered_on" value="{{ old('reffered_on', $patient->reffered_on) }}">
                @if($errors->has('reffered_on'))
                    <span class="text-danger">{{ $errors->first('reffered_on') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.reffered_on_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="referring_uhid">{{ trans('cruds.patient.fields.referring_uhid') }}</label>
                <input class="form-control {{ $errors->has('referring_uhid') ? 'is-invalid' : '' }}" type="text" name="referring_uhid" id="referring_uhid" value="{{ old('referring_uhid', $patient->referring_uhid) }}">
                @if($errors->has('referring_uhid'))
                    <span class="text-danger">{{ $errors->first('referring_uhid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.patient.fields.referring_uhid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.patient.fields.remarks') }}</label>
                <textarea class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" name="remarks" id="remarks">{{ old('remarks', $patient->remarks) }}</textarea>
                @if($errors->has('remarks'))
                    <span class="text-danger">{{ $errors->first('remarks') }}</span>
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



@endsection