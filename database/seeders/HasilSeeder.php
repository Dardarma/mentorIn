<?php

namespace Database\Seeders;

use App\Models\Hasil_mentoring;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HasilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hasil_mentoring::create([
            'hasil' => 'mentee sudah bisa php native',
            'feedback' => 'sudah bagus hanya perlu bisa komunikasi lebih baik',
            'todo_id' => '2'
        ]); 

        Hasil_mentoring::create([
            'hasil' => 'ndak tau',
            'feedback' => 'sudah bagus hanya perlu bisa komunikasi lebih baik',
            'todo_id' => '4'
        ]); 
    }
}
