<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('booking_attractions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('bookings');
            $table->foreignId('booking_product_id')->nullable()->constrained('booking_products');
            $table->timestamp('date')->nullable();
            $table->jsonb('product_snapshot')->nullable();
            $table->jsonb('package_snapshot')->nullable();
            $table->jsonb('quantity_snapshot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('booking_attractions');
    }
};
