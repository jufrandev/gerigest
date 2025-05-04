<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'location_id',
        'activity_type_id',
        'created_by',
    ];

    /**
     * Types of activities.
     *
     */
    public function activityType()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }

    /**
     * Relationship to the user who created the activity.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship to the events associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function events(): HasMany
    // {
    //     return $this->hasMany(Event::class);
    // }

    /**
     * Relationship to the location associated with the activity.
     *
     * @return BelongsTo
     *
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Casts for the model attributes.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

}
