<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'patients';

    protected $dates = [
        'registration_date',
        'dob',
        'reffered_on',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const GENDER_SELECT = [
        'Female'      => 'Female',
        'Male'        => 'Male',
        'Transgender' => 'Transgender',
        'Other'       => 'Other',
    ];

    public static $searchable = [
        'uhid_number',
        'abha',
        'mobile_number',
        'first_name',
        'middle_name',
        'last_name',
        'identification_number',
        'gurdian_name',
        'email',
        'mlc_number',
        'police_station',
        'referring_uhid',
    ];

    protected $fillable = [
        'registration_date',
        'is_mlc_patient',
        'uhid_number',
        'abha',
        'mobile_number',
        'salutation_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'patient_age_in_years',
        'patient_age_in_months',
        'patient_age_in_days',
        'identification_number',
        'address',
        'postal_code_id',
        'patient_category_id',
        'user_id',
        'province_id',
        'district_id',
        'relationship_id',
        'gurdian_name',
        'email',
        'nationality_id',
        'occupation_id',
        'education_id',
        'yearly_income_id',
        'mlc_number',
        'police_station',
        'mlc_remark',
        'is_referred_patient',
        'referred_by_id',
        'referring_hospital',
        'referring_department',
        'reffered_on',
        'referring_uhid',
        'remarks',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getRegistrationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setRegistrationDateAttribute($value)
    {
        $this->attributes['registration_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function salutation()
    {
        return $this->belongsTo(Salutation::class, 'salutation_id');
    }

    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function postal_code()
    {
        return $this->belongsTo(PostalCode::class, 'postal_code_id');
    }

    public function patient_category()
    {
        return $this->belongsTo(PatientCategory::class, 'patient_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function district()
    {
        return $this->belongsTo(PostalCode::class, 'district_id');
    }

    public function relationship()
    {
        return $this->belongsTo(PatientGuardianRelationship::class, 'relationship_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupation_id');
    }

    public function education()
    {
        return $this->belongsTo(PatientEducationLevel::class, 'education_id');
    }

    public function yearly_income()
    {
        return $this->belongsTo(PatientsIncomeGroup::class, 'yearly_income_id');
    }

    public function referred_by()
    {
        return $this->belongsTo(User::class, 'referred_by_id');
    }

    public function getRefferedOnAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setRefferedOnAttribute($value)
    {
        $this->attributes['reffered_on'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
