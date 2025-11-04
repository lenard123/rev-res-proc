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
        Schema::create('supplier_item_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->foreignId('uom_id')->constrained('unit_of_measures');
            $table->decimal('price', 19, 4);
            $table->string('currency')->default('PHP');
            $table->unique(['supplier_id', 'item_id', 'uom_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_item_prices');
    }
};
