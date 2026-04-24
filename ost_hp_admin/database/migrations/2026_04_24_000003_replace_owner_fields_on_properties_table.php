<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['owner_name', 'owner_kana', 'owner_phone', 'owner_email', 'owner_address', 'owner_note']);
            $table->foreignId('owner_id')->nullable()->constrained('owners')->nullOnDelete()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');
            $table->string('owner_name')->nullable();
            $table->string('owner_kana')->nullable();
            $table->string('owner_phone')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('owner_address')->nullable();
            $table->text('owner_note')->nullable();
        });
    }
};
