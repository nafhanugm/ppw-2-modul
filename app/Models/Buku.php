<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $table = "books";

    protected $fillable = [
        "judul",
        "penulis",
        "harga",
        "tgl_terbit",
        "filename",
        "filepath",
        "editorial_pick",
        "discount_percentage",
    ];

    protected $casts = [
        "tgl_terbit" => "date",
    ];

    public function getDiscountedPriceAttribute(): string
    {
        $discountedPrice =
            $this->harga - ($this->harga * $this->discount_percentage) / 100;
        setlocale(LC_MONETARY, "id_ID"); // Indonesian locale for Rupiah
        if (function_exists("money_format")) {
            return money_format("%.0n", $discountedPrice); //  '%.0n' for no decimals with thousands separators
        } else {
            return number_format($discountedPrice, 2, ",", ".");
        }
    }

    public function getAllRelatedBooksAttribute(): array
    {
        $relatedBooks = $this->relatedBooks->map(function ($relatedBook) {
            return $relatedBook->relatedBook;
        });

        $relatedBooks2 = $this->relatedBooks2->map(function ($relatedBook) {
            return $relatedBook->book;
        });

        return $relatedBooks->merge($relatedBooks2)->all();
    }

    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, "book_id");
    }

    public function relatedBooks(): HasMany
    {
        return $this->hasMany(RelatedBook::class, "book_id");
    }

    public function relatedBooks2(): HasMany
    {
        return $this->hasMany(RelatedBook::class, "related_book_id");
    }
}
