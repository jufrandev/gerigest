<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    /**
     * Relationship to the note type.
     *
     * @return BelongsTo
     */
    public function noteType(): BelongsTo
    {
        return $this->belongsTo(NoteType::class);
    }

    /**
     * Relationship to the priority.
     *
     * @return BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    /**
     * Relationship to the user who created the note.
     *
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }



}
