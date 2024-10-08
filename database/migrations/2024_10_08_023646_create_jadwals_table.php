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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal_mentoring');
            $table->time('jam_mentoring');
            $table->unsignedBigInteger('todo_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mentor_id');
            $table->unsignedBigInteger('materi_id');
            $table->timestamps();

            $table->foreign('todo_id')->references('id')->on('to_do');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('mentor_id')->references('id')->on('mentors');
            $table->foreign('materi_id')->references('id')->on('materi_mentorings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};