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
        Schema::create("galeri", function (Blueprint $table) {
            $table->id();
            //nama_galeri, galeri_seo, keterangan, foto, buku_id on delete cascade
            $table->string("nama_galeri");
            $table->string("path")->nullable();
            $table->string("galeri_seo")->nullable();
            $table->string("foto");
            $table->unsignedBigInteger("buku_id");
            $table
                ->foreign("buku_id")
                ->references("id")
                ->on("books")
                ->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("galeris");
    }
};
