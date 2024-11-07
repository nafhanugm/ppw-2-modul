<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'judul',
        'penulis',
        'harga',
        'tgl_terbit',
        'filename',
        'filepath',
    ];

    protected $casts = [
        'tgl_terbit' => 'date',
    ];

    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class);
    }
}
