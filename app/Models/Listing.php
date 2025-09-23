<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'type', 'description'];

    // Polymorphic relation for reviews
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, );
    }

    // Polymorphic relation for media
    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function wishlistedBy()
{
    return $this->belongsToMany(User::class, 'wishlist');
}
}