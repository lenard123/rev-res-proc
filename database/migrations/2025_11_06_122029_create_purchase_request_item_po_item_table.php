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
        Schema::create('purchase_request_item_po_item', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_request_item_id')
                ->unique()
                ->constrained('purchase_request_items')
                ->cascadeOnDelete();

            $table->foreignId('purchase_order_item_id')
                ->constrained('purchase_order_items')
                ->cascadeOnDelete();

            /**
             * Allocated quantity *in the item's base UOM*.
             *
             * Example:
             *  - Item base UOM = piece
             *  - PR: 10 box  (1 box = 12 pcs)  => 120 base
             *  - PO: 60 pcs                   => 60 base
             *  - Here you might allocate 60 base to this PO line.
             */
            $table->decimal('quantity_allocated_base', 24, 8);


            $table->unique(
                ['purchase_request_item_id', 'purchase_order_item_id'],
                'pri_poi_unique'
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_request_item_po_item');
    }
};
