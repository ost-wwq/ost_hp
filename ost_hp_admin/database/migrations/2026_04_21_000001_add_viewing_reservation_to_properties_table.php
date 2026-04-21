<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->boolean('viewing_enabled')->default(false)->after('confirm_pin');
            $table->string('viewing_keybbox_number')->nullable()->after('viewing_enabled');
            $table->string('viewing_keybbox_image')->nullable()->after('viewing_keybbox_number');
            $table->text('viewing_keybbox_description')->nullable()->after('viewing_keybbox_image');
            $table->string('viewing_url')->nullable()->after('viewing_keybbox_description');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'viewing_enabled',
                'viewing_keybbox_number',
                'viewing_keybbox_image',
                'viewing_keybbox_description',
                'viewing_url',
            ]);
        });
    }
};
