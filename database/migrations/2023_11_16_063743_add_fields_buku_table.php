<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('buku', function(Blueprint $table) {
            $table->string('buku_seo');
            $table->string('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('buku', function(Blueprint $table) {
            $table->dropColumn('buku_seo');
            $table->dropColumn('foto');
        });
    }
};
