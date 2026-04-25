<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_consents', function (Blueprint $table) {
            $table->longText('business_card_data')->nullable()->after('business_card');
            $table->string('business_card_mime')->nullable()->after('business_card_data');
        });

        Schema::table('viewing_reservations', function (Blueprint $table) {
            $table->longText('business_card_data')->nullable()->after('business_card');
            $table->string('business_card_mime')->nullable()->after('business_card_data');
        });
    }

    public function down(): void
    {
        Schema::table('property_consents', function (Blueprint $table) {
            $table->dropColumn(['business_card_data', 'business_card_mime']);
        });

        Schema::table('viewing_reservations', function (Blueprint $table) {
            $table->dropColumn(['business_card_data', 'business_card_mime']);
        });
    }
};
