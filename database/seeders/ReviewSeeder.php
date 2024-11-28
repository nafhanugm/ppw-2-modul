<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            "user_id" => 3,
            "book_id" => 1,
            "review" => "Buku ini sangat bagus, saya suka dengan isi bukunya.",
        ]);

        Review::create([
            "user_id" => 4,
            "book_id" => 2,
            "review" => "Buku ini sangat bagus, saya suka dengan isi bukunya.",
        ]);

        Review::create([
            "user_id" => 5,
            "book_id" => 3,
            "review" => "Buku ini sangat bagus, saya suka dengan isi bukunya.",
        ]);

        Review::create([
            "user_id" => 6,
            "book_id" => 4,
            "review" => "Buku ini sangat bagus, saya suka dengan isi bukunya.",
        ]);
    }
}
