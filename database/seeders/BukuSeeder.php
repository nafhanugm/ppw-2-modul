<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Buku::create([
                "judul" => $this->fakeBookName(),
                "penulis" => fake()->name(),
                "harga" => fake()->numberBetween(10000, 50000),
                "tgl_terbit" => fake()->date(),
                "filepath" => "/images/book.jpg",
            ]);
        }
    }

    private function fakeBookName(): string
    {
        $bookNames = [
            "The Great Gatsby",
            "To Kill a Mockingbird",
            "1984",
            "Pride and Prejudice",
            "The Catcher in the Rye",
            "The Hobbit",
            "Fahrenheit 451",
            "The Lord of the Rings",
            "Animal Farm",
            "Brave New World",
        ];
        $selectedBookName = $bookNames[array_rand($bookNames)];
        unset($bookNames[array_search($selectedBookName, $bookNames)]);
        return $selectedBookName;
    }
}
