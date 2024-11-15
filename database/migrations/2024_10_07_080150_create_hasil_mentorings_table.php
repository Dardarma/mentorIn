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
            $table->unsignedBigInteger('todo_id');
            $table->timestamps();
            
            $table->foreign('todo_id')->references('id')->on('to_do')->onDelete('cascade');
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
