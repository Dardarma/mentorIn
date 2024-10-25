<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
           // Set the column to nullable first
        Schema::table('periodes', function (Blueprint $table) {
            $table->timestamp('lama_magang')->nullable()->change();
        });

        // Use raw SQL to convert timestamp to integer
        DB::statement('ALTER TABLE periodes ALTER COLUMN lama_magang TYPE INTEGER USING EXTRACT(EPOCH FROM lama_magang)::integer');

        // Set column to not null after type change
        Schema::table('periodes', function (Blueprint $table) {
            $table->integer('lama_magang')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
