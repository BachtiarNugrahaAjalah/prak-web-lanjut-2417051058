<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
        });

        // Isi UUID untuk data yang sudah ada
        DB::table('user')->whereNull('uuid')->get()->each(function ($row) {
            DB::table('user')->where('id', $row->id)->update(['uuid' => (string) Str::uuid()]);
        });

        Schema::table('user', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
