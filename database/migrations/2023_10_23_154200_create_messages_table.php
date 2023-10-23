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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('type'); # тип повідомлення(скарга, неточність, закінчення послуги, адмін)
            $table->string('title'); # заголовок для списку повідомлень
            $table->text('text'); # текст повідомлення
            $table->unsignedTinyInteger('opened')->default(0); # переглянуті/ні
            $table->foreignId('places_id')->constrained()->onDelete('cascade'); # привязка до закладу
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
