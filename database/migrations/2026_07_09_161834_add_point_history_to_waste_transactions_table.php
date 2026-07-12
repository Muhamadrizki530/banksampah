<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('waste_transactions', function (Blueprint $table) {
            $table->integer('point_before')->default(0)->after('total_point');
            $table->integer('point_after')->default(0)->after('point_before');
        });
    }

    public function down(): void
    {
        Schema::table('waste_transactions', function (Blueprint $table) {
            $table->dropColumn(['point_before', 'point_after']);
        });
    }
};