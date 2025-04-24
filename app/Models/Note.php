<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Note extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'content',
        'note_type_id',
        'priority_id',
        'created_by',
    ];

    public function noteType()
    {
        return $this->belongsTo(NoteType::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }



}
