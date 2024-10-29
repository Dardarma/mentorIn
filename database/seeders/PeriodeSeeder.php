<?php

namespace Database\Seeders;

use App\Models\periode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        periode::create([
            'tanggal_mulai' => '2025-01-01',
            'tanggal_akhir' => '2025-02-01',
            'durasi_magang(bulan)' => '1',
        ]);
    }
}
