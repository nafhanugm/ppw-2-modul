<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("related_books", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("related_book_id");
            $table->foreignId("book_id")->constrained();
            $table->foreign("related_book_id")->references("id")->on("books");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("related_books");
    }
};
