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
        Schema::create('supplier_item_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_item_id')->constrained('supplier_items');
            $table->foreignId('uom_id')->comment("This is the supplier's sell unit for THIS offer")->constrained('unit_of_measures');
            $table->string('supplier_sku')->nullable()->comment("The supplier's internal SKU / part number.");
            $table->text('description_override')->nullable()->comment('Sometimes your catalog name is "Polypropylene Container 32L" but vendor calls it "STORAGE BIN GRAY 32L HD". You want to store how THEY label it.');
            $table->decimal('conversion_factor_to_item_uom', 15, 6)->comment("how many of the item's base UOM are in 1 of this offer's UOM");
            $table->decimal('last_quoted_price', 15, 4)->comment("Most recent agreed or quoted unit price.");
            $table->decimal('min_order_qty', 15, 4);
            $table->boolean('is_default');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_item_offers');
    }
};
