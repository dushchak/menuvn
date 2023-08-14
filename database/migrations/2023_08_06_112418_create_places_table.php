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
            // $value = ''; // empty value
            
            $table->id();
            $table->string('name');       # назва закладу
            $table->string('adress');     #
            $table->string('workhours');  # робочі години
            $table->text('description');         # опис закладу
            $table->unsignedSmallInteger('sitplaces')->default(0);   # посадочн місць
            $table->string('delivery')->nullable();   # що по доставці
            $table->string('manager');    # контакти керуючого viber,tg,....
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('phone4')->nullable();
            $table->string('email')->nullable();
            $table->string('viber')->nullable();
            $table->string('telegram')->nullable();
            $table->string('insta')->nullable();
            $table->string('fb')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedTinyInteger('disabled')->default(0);
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
