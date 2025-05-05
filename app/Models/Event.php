<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'created_by',
        'activity_id',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function getTitleAttribute()
    {
        return $this->activity->name ?? 'Sin actividad asociasda';
    }
    
}
