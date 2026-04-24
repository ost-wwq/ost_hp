<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete()->after('id');
            $table->text('free_text')->nullable()->after('sent_to');
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropConstrainedForeignId('property_id');
            $table->dropColumn('free_text');
        });
    }
};
