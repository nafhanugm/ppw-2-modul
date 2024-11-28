<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TagReview extends Model
{
    use HasFactory;

    protected $table = "tag_reviews";

    protected $fillable = ["tag_id", "review_id"];

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }
}
