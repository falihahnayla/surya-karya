<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visi_misi', function (Blueprint $table) {
            $table->string('visi_title', 100)->nullable()->after('id');
            $table->text('visi_content')->nullable()->after('visi_title');
            $table->string('misi_title', 100)->nullable()->after('visi_content');
            $table->text('misi_content')->nullable()->after('misi_title');
        });

        // Pindahkan data lama: baris 1 -> Visi, baris 2 -> Misi, sisanya dihapus
        $rows = DB::table('visi_misi')->orderBy('id')->get();

        if ($rows->isNotEmpty()) {
            $first  = $rows->get(0);
            $second = $rows->get(1);

            DB::table('visi_misi')->where('id', $first->id)->update([
                'visi_title'   => $first->title,
                'visi_content' => $first->content,
                'misi_title'   => $second?->title ?? 'MISI',
                'misi_content' => $second?->content,
            ]);

            DB::table('visi_misi')->where('id', '!=', $first->id)->delete();
        }

        Schema::table('visi_misi', function (Blueprint $table) {
            $table->dropColumn(['title', 'content']);
        });
    }

    public function down(): void
    {
        Schema::table('visi_misi', function (Blueprint $table) {
            $table->text('title')->nullable();
            $table->string('content', 255)->nullable();
        });

        Schema::table('visi_misi', function (Blueprint $table) {
            $table->dropColumn(['visi_title', 'visi_content', 'misi_title', 'misi_content']);
        });
    }
};