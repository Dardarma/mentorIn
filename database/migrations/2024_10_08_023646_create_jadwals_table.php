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
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal_mentoring');
            $table->time('jam_mentoring');
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('todo_id');
            $table->unsignedBigInteger('mentor_id');
            $table->unsignedBigInteger('materi_id');
            $table->unsignedBigInteger('hasil_id')->nullable();
            $table->timestamps();

            $table->foreign('materi_id')->references('id')->on('materi_mentorings')->onDelete('cascade');
            $table->foreign('hasil_id')->references('id')->on('hasil_mentorings')->onDelete('cascade');
            $table->foreign('todo_id')->references('id')->on('to_do')->onDelete('cascade');
            $table->foreign('mentor_id')->references('user_id')->on('users');
            $table->foreign('user_id')->references('user_id')->on('users');
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
