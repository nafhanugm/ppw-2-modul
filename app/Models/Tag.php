<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    protected $table = "tags";

    protected $fillable = ["tag_name"];

    public function tagReviews(): HasMany
    {
        return $this->hasMany(TagReview::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasManyThrough(Review::class, TagReview::class);
    }
}
