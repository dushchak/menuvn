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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('dishtitle');
            $table->unsignedTinyInteger('dishgroup')->default(1); 
            $table->text('description');
            $table->string('portionweight')->nullable();
            $table->string('portioncost');
            $table->string('cost100g')->nullable();
            $table->tinyInteger('position')->default(1);
            $table->string('thumbnail')->nullable();
            $table->foreignId('places_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
