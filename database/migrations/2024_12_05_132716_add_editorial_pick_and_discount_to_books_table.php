<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table("books", function (Blueprint $table) {
            $table->boolean("editorial_pick")->default(false);
            $table->integer("discount_percentage")->default(0); // Untuk diskon
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("books", function (Blueprint $table) {
            $table->dropColumn("editorial_pick");
            $table->dropColumn("discount_percentage");
        });
    }
};
