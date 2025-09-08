<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'type', 'description'];

    // Polymorphic relation for reviews
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    // Polymorphic relation for media
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}