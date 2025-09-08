<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'path', 'type']; // type could be 'image' or 'video'

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Defines the polymorphic relationship
    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}