<?php

namespace Database\Seeders;

use App\Models\Materi_mentoring;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materi_mentoring::create([
            'materi' => 'php',
            'description' => 'php native dan mvc'
        ]);
        Materi_mentoring::create([
            'materi' => 'css',
            'description' => 'styling css'
        ]);
    }
}
