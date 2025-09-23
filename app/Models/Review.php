<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'body',
        'listing_id',
        'listing_type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function listing(): BelongsTo
    {
        // A review belongs to a single listing
        return $this->belongsTo(Listing::class);
    }
    // Defines the polymorphic relationship
    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }
}
