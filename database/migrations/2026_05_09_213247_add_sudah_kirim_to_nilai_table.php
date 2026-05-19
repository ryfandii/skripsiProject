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
    Schema::table('nilai', function (Blueprint $table) {
        $table->boolean('sudah_kirim')->default(false)->after('nilai_akhir');
    });
}

public function down(): void
{
    Schema::table('nilai', function (Blueprint $table) {
        $table->dropColumn('sudah_kirim');
    });
}
};
