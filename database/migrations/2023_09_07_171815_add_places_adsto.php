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
        if (!Schema::hasColumn('places', 'adsto')) {
        // Таблица `places` существует и содержит столбец `wifipass` ...

            Schema::table('places', function (Blueprint $table) {
                $table->date('adsto')->after('position')->nullable();
            });

            DB::table('places')->update([
                'adsto' => "2023-01-01",
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('adsto');
        });
    }
};
