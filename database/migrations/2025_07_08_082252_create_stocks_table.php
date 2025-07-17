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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();           // Ürün adı
            $table->string('unit')->default('adet');   // Birim (adet, kg vs)
            $table->integer('stock')->default(0);      // Mevcut stok miktarı
            $table->decimal('buying_price', 10, 2);    // Alış fiyatı
            $table->decimal('selling_price', 10, 2);   // Satış fiyatı
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
