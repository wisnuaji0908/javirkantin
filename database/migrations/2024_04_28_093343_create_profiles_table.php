<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_profile', function (Blueprint $table) {
            $table->id();
            $table->string("nama_toko");
            $table->integer("nomor_toko");
            $table->string("nomor_telp");
            $table->integer("user_id");
            $table->enum("lokasi",["MM", "TP"]);
            $table->text("deskripsi_toko");
            $table->string("label");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_profile');
    }
};
