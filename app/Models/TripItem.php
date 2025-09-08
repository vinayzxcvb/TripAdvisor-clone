<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripItem extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'listing_id', 'day_number', 'notes'];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}