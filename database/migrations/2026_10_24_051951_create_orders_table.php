<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pelanggan');
        $table->integer('total_harga')->default(0);
        $table->enum('metode_pembayaran', ['tunai', 'qris']); // Hanya menerima 2 value ini
        $table->enum('status', ['pending', 'diproses', 'selesai', 'dibatalkan'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
