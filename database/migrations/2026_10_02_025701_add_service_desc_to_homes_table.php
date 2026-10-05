<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('homes', 'service_desc')) {
            Schema::table('homes', function (Blueprint $table) {
                $table->string('service_desc', 100)->default('')->after('service_title');
            });
        }
    }

    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropColumn('service_desc');
        });
    }
};