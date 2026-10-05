<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alur_kerja', function (Blueprint $table) {
            $table->id();
            $table->integer('no');
            $table->string('title', 225);
            $table->string('content', 255);
            $table->text('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alur_kerja');
    }
};