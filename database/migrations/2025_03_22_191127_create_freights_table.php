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
        Schema::create('freights', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class,'user_id');
            $table->foreignIdFor(\App\Models\Order::class,'order_id');
            $table->foreignIdFor(\App\Models\User::class ,'driver_id')->nullable();
            $table->decimal('price');
            $table->decimal('products_price');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freights');
    }
};
