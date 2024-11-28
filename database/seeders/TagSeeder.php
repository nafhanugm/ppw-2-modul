<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a tag
        Tag::create([
            "tag_name" => "Fiksi",
        ]);

        Tag::create([
            "tag_name" => "Non-Fiksi",
        ]);

        Tag::create([
            "tag_name" => "Horror",
        ]);

        Tag::create([
            "tag_name" => "Romance",
        ]);

        Tag::create([
            "tag_name" => "Comedy",
        ]);

        Tag::create([
            "tag_name" => "Action",
        ]);
    }
}
