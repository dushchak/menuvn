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
        if (!Schema::hasColumn('places', 'noadsto')) {
        // Таблица `places` существует и содержит столбец `wifipass` ...

            Schema::table('places', function (Blueprint $table) {
                $table->date('noadsto')->after('adsto')->nullable();
            });

            DB::table('places')->update([
                'noadsto' => "2023-01-01",
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('noadsto');
        });
    }
};
