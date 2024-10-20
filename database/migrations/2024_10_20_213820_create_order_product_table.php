<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();

            $table->decimal('price');
            $table->decimal('quantity');

            $table->foreignId('order_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
