<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('viewing_reservations', function (Blueprint $table) {
            $table->date('reserved_date')->nullable()->after('business_card');
            $table->string('reserved_time', 5)->nullable()->after('reserved_date');
        });
    }

    public function down(): void
    {
        Schema::table('viewing_reservations', function (Blueprint $table) {
            $table->dropColumn(['reserved_date', 'reserved_time']);
        });
    }
};
