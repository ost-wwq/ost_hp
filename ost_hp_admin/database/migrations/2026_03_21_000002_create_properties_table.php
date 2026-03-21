<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');                          // 物件名
            $table->string('property_type');                  // 種別: マンション/一戸建て/土地/事務所など
            $table->string('status')->default('available');   // available/contract/closed
            $table->unsignedBigInteger('price');              // 価格（万円）
            $table->string('address');                        // 所在地
            $table->decimal('area', 8, 2)->nullable();        // 面積（㎡）
            $table->string('rooms')->nullable();              // 間取り: 1K / 2LDK etc
            $table->unsignedInteger('age')->nullable();       // 築年数
            $table->text('description')->nullable();          // 物件説明
            $table->string('main_image')->nullable();         // メイン画像パス
            $table->json('images')->nullable();               // 追加画像パス一覧
            $table->boolean('published')->default(false);     // 公開フラグ
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
