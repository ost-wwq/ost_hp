<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained()->cascadeOnDelete();
            $table->enum('direction', ['outbound', 'inbound'])->default('outbound');
            $table->text('body');
            $table->string('reply_token')->nullable()->unique(); // for inbound matching
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_replies');
    }
};
