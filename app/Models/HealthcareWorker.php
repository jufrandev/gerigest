<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthcareWorker extends Model
{
    use HasFactory;

    protected $table = 'healthcare_workers';
    
    protected $fillable = [
        'user_id',
        'qualification',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
