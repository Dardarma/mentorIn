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
        Schema::create('hasil_mentorings', function (Blueprint $table) {
            $table->id();
            $table->text('hasil');
            $table->text('feedback');
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('todo_id');
            $table->timestamps();
            
            $table->foreign('jadwal_id')->references('id')->on('jadwals');
            $table->foreign('todo_id')->references('id')->on('to_do');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_mentorings');
    }
};
