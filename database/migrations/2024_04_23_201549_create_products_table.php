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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price_buy');
            $table->string('price_sell')->nullable();
            $table->string('price_discount')->nullable();
            $table->string('weight_discount')->nullable();
            $table->string('dirt')->nullable();
            $table->string('count')->default(0);
            $table->string('slug');
            $table->boolean('is_published')->nullable();
            $table->string('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
