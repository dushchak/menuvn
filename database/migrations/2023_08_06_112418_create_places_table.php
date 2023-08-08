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
            $value = ''; // empty value
            
            $table->id();
            $table->string('name');       # назва закладу
            $table->string('adress');     #
            $table->string('workhours');  # робочі години
            $table->text('description');         # опис закладу
            $table->unsignedSmallInteger('sitplaces')->default(0);   # посадочн місць
            $table->string('delivery')->default($value);   # що по доставці
            $table->string('manager');    # контакти керуючого viber,tg,....
            $table->string('phone1')->default($value);
            $table->string('phone2')->default($value);
            $table->string('phone3')->default($value);
            $table->string('phone4')->default($value);
            $table->string('email')->default($value);
            $table->string('viber')->default($value);
            $table->string('telegram')->default($value);
            $table->string('insta')->default($value);
            $table->string('fb')->default($value);
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
