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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable(); 
            $table->string('img'); # filename
            $table->unsignedTinyInteger('typeads',1)->default(0); #img / img+txt
            $table->date('payed_at')->nullable(); # date
            $table->unsignedTinyInteger('moderate',1)->default(0); # 0/1
            $table->foreignId('places_id')
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
