<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_panels', function (Blueprint $table) {
            $table->id();
            $table->string('panel_key')->unique(); // pembangunan, renovasi, spesifikasi_bangunan, standar_mutu
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_panels');
    }
};
