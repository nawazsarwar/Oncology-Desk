<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Country;
use App\Models\Occupation;
use App\Models\Patient;
use App\Models\PatientCategory;
use App\Models\PatientEducationLevel;
use App\Models\PatientGuardianRelationship;
use App\Models\PatientsIncomeGroup;
use App\Models\PostalCode;
use App\Models\Province;
use App\Models\Salutation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::with(['salutation', 'postal_code', 'patient_category', 'user', 'province', 'district', 'relationship', 'nationality', 'occupation', 'education', 'yearly_income', 'referred_by'])->get();

        return view('frontend.patients.index', compact('patients'));
    }

    public function create()
    {
        abort_if(Gate::denies('patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salutations = Salutation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $postal_codes = PostalCode::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patient_categories = PatientCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = PostalCode::pluck('district', 'id')->prepend(trans('global.pleaseSelect'), '');

        $relationships = PatientGuardianRelationship::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nationalities = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $occupations = Occupation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education = PatientEducationLevel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $yearly_incomes = PatientsIncomeGroup::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $referred_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.patients.create', compact('districts', 'education', 'nationalities', 'occupations', 'patient_categories', 'postal_codes', 'provinces', 'referred_bies', 'relationships', 'salutations', 'users', 'yearly_incomes'));
    }

    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->all());

        return redirect()->route('frontend.patients.index');
    }

    public function edit(Patient $patient)
    {
        abort_if(Gate::denies('patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salutations = Salutation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $postal_codes = PostalCode::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patient_categories = PatientCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = PostalCode::pluck('district', 'id')->prepend(trans('global.pleaseSelect'), '');

        $relationships = PatientGuardianRelationship::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nationalities = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $occupations = Occupation::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education = PatientEducationLevel::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $yearly_incomes = PatientsIncomeGroup::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $referred_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patient->load('salutation', 'postal_code', 'patient_category', 'user', 'province', 'district', 'relationship', 'nationality', 'occupation', 'education', 'yearly_income', 'referred_by');

        return view('frontend.patients.edit', compact('districts', 'education', 'nationalities', 'occupations', 'patient', 'patient_categories', 'postal_codes', 'provinces', 'referred_bies', 'relationships', 'salutations', 'users', 'yearly_incomes'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->all());

        return redirect()->route('frontend.patients.index');
    }

    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->load('salutation', 'postal_code', 'patient_category', 'user', 'province', 'district', 'relationship', 'nationality', 'occupation', 'education', 'yearly_income', 'referred_by');

        return view('frontend.patients.show', compact('patient'));
    }

    public function destroy(Patient $patient)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->delete();

        return back();
    }

    public function massDestroy(MassDestroyPatientRequest $request)
    {
        $patients = Patient::find(request('ids'));

        foreach ($patients as $patient) {
            $patient->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
