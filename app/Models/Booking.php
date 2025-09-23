<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'listing_id',
        'check_in_date',
        'check_out_date',
        'number_of_guests',
        'total_price',
        'status',
    ];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
