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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->constrained()->onDelete('cascade'); // Hangi ürün
            $table->foreignId('firm_id')->nullable()->constrained()->onDelete('set null'); // Hangi firma
            $table->enum('movement_type', ['giris', 'cikis'])->index(); // Giriş mi çıkış mı
            $table->integer('quantity'); // Miktar
            $table->decimal('unit_price', 10, 2); // İşlem fiyatı (giriş/çıkış fiyatı)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
