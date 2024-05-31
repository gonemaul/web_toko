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
        Schema::create('supplay_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembelian');
            $table->string('tanggal');
            $table->string('no_nota');
            $table->string('jumlah_nota');
            $table->string('total_item');
            $table->string('total_pembelian');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplay_summaries');
    }
};
