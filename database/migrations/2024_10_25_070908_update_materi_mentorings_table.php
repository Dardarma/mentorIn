<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hasil_mentorings', function (Blueprint $table) {
            // Gantilah 'column_name' dengan nama kolom yang ingin dihapus
            $table->dropColumn('materi_id');
        });
    }

    public function down()
    {
        Schema::table('materi_mentorings', function (Blueprint $table) {
            // Tambahkan kembali kolom yang dihapus (sesuaikan tipe datanya jika perlu)
            $table->addColumn('column_type', 'column_name');
        });
    }
};