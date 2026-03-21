<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // 初期値: ブローカー確認PIN（デフォルト: 0000）
        DB::table('settings')->insert([
            ['key' => 'broker_pin', 'value' => '0000', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'broker_enabled', 'value' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'broker_title', 'value' => '物件ご紹介可能確認', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'broker_note', 'value' => '以下の物件について現在のご紹介状況をご確認いただけます。', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
