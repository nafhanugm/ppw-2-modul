<?php

namespace Database\Seeders;

use App\Models\TagReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TagReview::create([
            "tag_id" => 1,
            "review_id" => 1,
        ]);

        TagReview::create([
            "tag_id" => 2,
            "review_id" => 1,
        ]);

        TagReview::create([
            "tag_id" => 3,
            "review_id" => 1,
        ]);

        TagReview::create([
            "tag_id" => 4,
            "review_id" => 2,
        ]);

        TagReview::create([
            "tag_id" => 5,
            "review_id" => 2,
        ]);

        TagReview::create([
            "tag_id" => 6,
            "review_id" => 2,
        ]);

        TagReview::create([
            "tag_id" => 1,
            "review_id" => 3,
        ]);

        TagReview::create([
            "tag_id" => 2,
            "review_id" => 4,
        ]);

        TagReview::create([
            "tag_id" => 3,
            "review_id" => 3,
        ]);

        TagReview::create([
            "tag_id" => 4,
            "review_id" => 3,
        ]);
    }
}
