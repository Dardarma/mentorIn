<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jadwal::create([
            'tanggal_mentoring' => '2025-01-01',
            'jam_mentoring' => '00:00:00',
            'status' => true,
            'todo_id' => '1',
            'user_id' => '3',
            'mentor_id' => '4',
            'materi_id' => '1'
        ]);
        Jadwal::create([
            'tanggal_mentoring' => '2025-02-02',
            'jam_mentoring' => '01:01:01',
            'todo_id' => '3',
            'user_id' => '3',
            'mentor_id' => '4',
            'materi_id' => '2'
        ]);
    }
}
