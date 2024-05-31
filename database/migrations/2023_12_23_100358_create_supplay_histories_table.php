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
        Schema::create('supplay_histories', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembelian');
            $table->foreignId('barang_id');
            $table->string('banyak');
            $table->string('harga_satuan');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplay_histories');
    }
};
