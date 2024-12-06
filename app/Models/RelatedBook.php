<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedBook extends Model
{
    use HasFactory;

    protected $table = "related_books";

    protected $fillable = ["book_id", "related_book_id"];

    public function book()
    {
        return $this->belongsTo(Buku::class, "book_id");
    }

    public function relatedBook()
    {
        return $this->belongsTo(Buku::class, "related_book_id");
    }
}
