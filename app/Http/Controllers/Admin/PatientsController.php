<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class PatientsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Patient::with(['salutation', 'postal_code', 'patient_category', 'user', 'province', 'district', 'relationship', 'nationality', 'occupation', 'education', 'yearly_income', 'referred_by'])->select(sprintf('%s.*', (new Patient)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'patient_show';
                $editGate      = 'patient_edit';
                $deleteGate    = 'patient_delete';
                $crudRoutePart = 'patients';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('uhid_number', function ($row) {
                return $row->uhid_number ? $row->uhid_number : '';
            });
            $table->editColumn('mobile_number', function ($row) {
                return $row->mobile_number ? $row->mobile_number : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? Patient::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('patient_age_in_years', function ($row) {
                return $row->patient_age_in_years ? $row->patient_age_in_years : '';
            });
            $table->addColumn('patient_category_title', function ($row) {
                return $row->patient_category ? $row->patient_category->title : '';
            });

            $table->addColumn('district_district', function ($row) {
                return $row->district ? $row->district->district : '';
            });

            $table->addColumn('referred_by_name', function ($row) {
                return $row->referred_by ? $row->referred_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'patient_category', 'district', 'referred_by']);

            return $table->make(true);
        }

        return view('admin.patients.index');
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

        return view('admin.patients.create', compact('districts', 'education', 'nationalities', 'occupations', 'patient_categories', 'postal_codes', 'provinces', 'referred_bies', 'relationships', 'salutations', 'users', 'yearly_incomes'));
    }

    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->all());

        return redirect()->route('admin.patients.index');
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

        return view('admin.patients.edit', compact('districts', 'education', 'nationalities', 'occupations', 'patient', 'patient_categories', 'postal_codes', 'provinces', 'referred_bies', 'relationships', 'salutations', 'users', 'yearly_incomes'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->all());

        return redirect()->route('admin.patients.index');
    }

    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->load('salutation', 'postal_code', 'patient_category', 'user', 'province', 'district', 'relationship', 'nationality', 'occupation', 'education', 'yearly_income', 'referred_by');

        return view('admin.patients.show', compact('patient'));
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
