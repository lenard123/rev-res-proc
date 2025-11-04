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
        Schema::create('supplier_item_offer_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_item_offer_id')->constrained('supplier_item_offers')->cascadeOnDelete();
            $table->decimal('unit_price', 15, 4);
            $table->char('currency', 3)->default('PHP');
            $table->datetime('valid_from');
            $table->datetime('valid_to')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_item_offer_prices');
    }
};
