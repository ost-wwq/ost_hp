<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->longText('main_image_data')->nullable()->after('main_image');
            $table->string('main_image_mime')->nullable()->after('main_image_data');
            $table->json('images_data')->nullable()->after('images');
            $table->json('images_mimes')->nullable()->after('images_data');
            $table->longText('viewing_keybbox_image_data')->nullable()->after('viewing_keybbox_image');
            $table->string('viewing_keybbox_image_mime')->nullable()->after('viewing_keybbox_image_data');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'main_image_data', 'main_image_mime',
                'images_data', 'images_mimes',
                'viewing_keybbox_image_data', 'viewing_keybbox_image_mime',
            ]);
        });
    }
};
