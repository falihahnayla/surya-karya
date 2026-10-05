<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 30)->unique();
            $table->string('name', 255);
            $table->string('company_name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 50);
            $table->text('address');
            // Sesuaikan nama tabel layanan Anda jika bukan "services"
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->unsignedInteger('building_area')->nullable(); // Luas bangunan (m²)
            $table->unsignedInteger('land_area')->nullable();     // Luas lahan (m²)
            $table->string('building_position', 255)->nullable();
            $table->text('project_detail');
            $table->text('denah_image')->nullable();
            $table->text('lahan_image')->nullable();
            $table->text('notes')->nullable();
            // Data tambahan yang diisi admin di backoffice
            $table->decimal('total', 15, 2)->default(0);
            $table->decimal('termin_1', 15, 2)->default(0);
            $table->decimal('termin_2', 15, 2)->default(0);
            $table->decimal('termin_3', 15, 2)->default(0);
            $table->enum('status', ['pending', 'deal', 'cancel'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};