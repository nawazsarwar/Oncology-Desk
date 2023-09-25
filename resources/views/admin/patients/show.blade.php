@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.patient.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.id') }}
                        </th>
                        <td>
                            {{ $patient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.registration_date') }}
                        </th>
                        <td>
                            {{ $patient->registration_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.is_mlc_patient') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $patient->is_mlc_patient ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.uhid_number') }}
                        </th>
                        <td>
                            {{ $patient->uhid_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.abha') }}
                        </th>
                        <td>
                            {{ $patient->abha }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.mobile_number') }}
                        </th>
                        <td>
                            {{ $patient->mobile_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.salutation') }}
                        </th>
                        <td>
                            {{ $patient->salutation->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.first_name') }}
                        </th>
                        <td>
                            {{ $patient->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $patient->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.last_name') }}
                        </th>
                        <td>
                            {{ $patient->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Patient::GENDER_SELECT[$patient->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.dob') }}
                        </th>
                        <td>
                            {{ $patient->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.patient_age_in_years') }}
                        </th>
                        <td>
                            {{ $patient->patient_age_in_years }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.patient_age_in_months') }}
                        </th>
                        <td>
                            {{ $patient->patient_age_in_months }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.patient_age_in_days') }}
                        </th>
                        <td>
                            {{ $patient->patient_age_in_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.identification_number') }}
                        </th>
                        <td>
                            {{ $patient->identification_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.address') }}
                        </th>
                        <td>
                            {{ $patient->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.postal_code') }}
                        </th>
                        <td>
                            {{ $patient->postal_code->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.patient_category') }}
                        </th>
                        <td>
                            {{ $patient->patient_category->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.user') }}
                        </th>
                        <td>
                            {{ $patient->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.province') }}
                        </th>
                        <td>
                            {{ $patient->province->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.district') }}
                        </th>
                        <td>
                            {{ $patient->district->district ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.relationship') }}
                        </th>
                        <td>
                            {{ $patient->relationship->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.gurdian_name') }}
                        </th>
                        <td>
                            {{ $patient->gurdian_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.email') }}
                        </th>
                        <td>
                            {{ $patient->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.nationality') }}
                        </th>
                        <td>
                            {{ $patient->nationality->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.occupation') }}
                        </th>
                        <td>
                            {{ $patient->occupation->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.education') }}
                        </th>
                        <td>
                            {{ $patient->education->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.yearly_income') }}
                        </th>
                        <td>
                            {{ $patient->yearly_income->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.mlc_number') }}
                        </th>
                        <td>
                            {{ $patient->mlc_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.police_station') }}
                        </th>
                        <td>
                            {{ $patient->police_station }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.mlc_remark') }}
                        </th>
                        <td>
                            {{ $patient->mlc_remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.is_referred_patient') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $patient->is_referred_patient ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.referred_by') }}
                        </th>
                        <td>
                            {{ $patient->referred_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.referring_hospital') }}
                        </th>
                        <td>
                            {{ $patient->referring_hospital }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.referring_department') }}
                        </th>
                        <td>
                            {{ $patient->referring_department }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.reffered_on') }}
                        </th>
                        <td>
                            {{ $patient->reffered_on }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.referring_uhid') }}
                        </th>
                        <td>
                            {{ $patient->referring_uhid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.remarks') }}
                        </th>
                        <td>
                            {{ $patient->remarks }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.created_at') }}
                        </th>
                        <td>
                            {{ $patient->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.patient.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $patient->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection