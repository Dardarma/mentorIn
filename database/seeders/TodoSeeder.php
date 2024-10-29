<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::create([
            'todo' => 'belajar php native',
            'tipe' => 'PRA',
        ]);
        Todo::create([
            'todo' => 'belajar php mvc',
            'tipe' => 'PAST',
        ]);
        Todo::create([
            'todo' => 'belajar css',
            'tipe' => 'PRA',
        ]);
        Todo::create([
            'todo' => 'belajar bootstrap',
            'tipe' => 'PAST',
        ]);
    }
}
