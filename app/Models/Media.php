<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * ADD THIS LINE to fix the error.
     */
    protected $table = 'medias';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'path',
        'listing_id',
        'listing_type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A media file belongs to one listing.
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}