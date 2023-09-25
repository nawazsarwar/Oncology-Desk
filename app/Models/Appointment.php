<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Appointment extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'appointments';

    protected $appends = [
        'history_documents',
    ];

    public const REPORTING_REQUIRED_SELECT = [
        'Yes' => 'Yes',
        'No'  => 'No',
    ];

    protected $dates = [
        'start_time',
        'finish_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'patient_id',
        'start_time',
        'finish_time',
        'priority_level_id',
        'status_id',
        'reporting_required',
        'contrast',
        'films',
        'investigation_performed_by_id',
        'referring_physician_id',
        'history',
        'added_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function studies()
    {
        return $this->belongsToMany(Study::class);
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getFinishTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setFinishTimeAttribute($value)
    {
        $this->attributes['finish_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function priority_level()
    {
        return $this->belongsTo(PriorityLevel::class, 'priority_level_id');
    }

    public function status()
    {
        return $this->belongsTo(AppointmentsStatuss::class, 'status_id');
    }

    public function investigation_performed_by()
    {
        return $this->belongsTo(User::class, 'investigation_performed_by_id');
    }

    public function referring_physician()
    {
        return $this->belongsTo(ReferringPhysician::class, 'referring_physician_id');
    }

    public function getHistoryDocumentsAttribute()
    {
        return $this->getMedia('history_documents');
    }

    public function added_by()
    {
        return $this->belongsTo(User::class, 'added_by_id');
    }
}
