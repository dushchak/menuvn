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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');       # назва закладу
            $table->string('adress');     #
            $table->string('workhours');  # робочі години
            $table->text('desc');         # опис закладу
            $table->float('sitplaces');   # посадочн місць
            $table->string('delivery');   # що по доставці
            $table->string('manager');    # контакти керуючого viber,tg,....
            $table->string('phone1');
            $table->string('phone2');
            $table->string('phone3');
            $table->string('phone4');
            $table->string('email');
            $table->string('viber');
            $table->string('telegram');
            $table->string('insta');
            $table->string('fb');
            $table->timestamps();
            $table->index('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
