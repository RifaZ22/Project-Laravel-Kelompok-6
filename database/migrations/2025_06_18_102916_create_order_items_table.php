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
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id');
        $table->unsignedBigInteger('produk_id');
        $table->integer('jumlah');
        $table->decimal('harga', 10, 2);
        $table->timestamps();

        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
