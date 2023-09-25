<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Report extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'reports';

    public static $searchable = [
        'text',
        'summary',
    ];

    public const SPECIAL_RADIO = [
        'Yes' => 'Yes',
        'No'  => 'No',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'appointment_id',
        'text',
        'summary',
        'status_id',
        'template_id',
        'special',
        'evolving',
        'allotted_to_id',
        'finalized_by_id',
        'approved_by_id',
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

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function status()
    {
        return $this->belongsTo(ReportStatuss::class, 'status_id');
    }

    public function template()
    {
        return $this->belongsTo(ReportTemplate::class, 'template_id');
    }

    public function allotted_to()
    {
        return $this->belongsTo(User::class, 'allotted_to_id');
    }

    public function finalized_by()
    {
        return $this->belongsTo(User::class, 'finalized_by_id');
    }

    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
