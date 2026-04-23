<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_consents', function (Blueprint $table) {
            $table->string('ad_other_text')->nullable()->after('ad_types');
        });
    }

    public function down(): void
    {
        Schema::table('property_consents', function (Blueprint $table) {
            $table->dropColumn('ad_other_text');
        });
    }
};
