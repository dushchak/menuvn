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
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('coins_before')->default(0);   # 1000
            $table->smallInteger('operation_sum');                      # -200; 150(+150)   
            $table->unsignedSmallInteger('coins_after');                # 800 
            $table->string('typeoperation');                            # поповн, за QR, за Топ, promo
            $table->string('comment');
            $table->unsignedSmallInteger('places_id');
            $table->foreignId('user_id')->constrained();               # OWNER COINS, id user
            $table->timestamps();                                       # create_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coins');
    }
};
