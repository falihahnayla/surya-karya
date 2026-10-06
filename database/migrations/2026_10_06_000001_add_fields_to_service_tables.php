<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['pembangunans', 'renovasis', 'spesifikasi_bangunans', 'standar_mutus'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'item_type')) {
                    $table->string('item_type')->default('card')->after('id');
                }
                if (!Schema::hasColumn($tableName, 'tag')) {
                    $table->string('tag')->nullable()->after('title');
                }
                if (!Schema::hasColumn($tableName, 'checklist')) {
                    $table->text('checklist')->nullable()->after('content');
                }
                if (!Schema::hasColumn($tableName, 'image')) {
                    $table->text('image')->nullable()->after('checklist');
                }
            });
        }
    }

    public function down(): void
    {
        $tables = ['pembangunans', 'renovasis', 'spesifikasi_bangunans', 'standar_mutus'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                $table->dropColumn(['item_type', 'tag', 'checklist', 'image']);
            });
        }
    }
};
