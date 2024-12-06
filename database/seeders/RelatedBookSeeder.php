<?php

namespace Database\Seeders;

use App\Models\RelatedBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelatedBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a related book
        RelatedBook::create([
            "book_id" => 1,
            "related_book_id" => 2,
        ]);

        RelatedBook::create([
            "book_id" => 1,
            "related_book_id" => 3,
        ]);

        RelatedBook::create([
            "book_id" => 4,
            "related_book_id" => 1,
        ]);

        RelatedBook::create([
            "book_id" => 2,
            "related_book_id" => 3,
        ]);
    }
}
