<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('orders', 'seen_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->timestamp('seen_at')->nullable()->after('status');
            });

            // Order yang sudah ada dianggap sudah dilihat, supaya bulatan hijau tidak menyala untuk data lama
            DB::table('orders')->update(['seen_at' => now()]);
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('orders', 'seen_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('seen_at');
            });
        }
    }
};