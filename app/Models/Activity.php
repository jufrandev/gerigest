<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'activity_type_id',
        'created_by',
    ];

    /**
     * Types of activities.
     *
     */
    public function activityTypes()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

}
