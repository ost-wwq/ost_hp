<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('owner_name')->nullable()->after('viewing_token');
            $table->string('owner_kana')->nullable()->after('owner_name');
            $table->string('owner_phone')->nullable()->after('owner_kana');
            $table->string('owner_email')->nullable()->after('owner_phone');
            $table->string('owner_address')->nullable()->after('owner_email');
            $table->text('owner_note')->nullable()->after('owner_address');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['owner_name', 'owner_kana', 'owner_phone', 'owner_email', 'owner_address', 'owner_note']);
        });
    }
};
