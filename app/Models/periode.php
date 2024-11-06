<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periode extends Model
{
    use HasFactory;

    protected $table = 'periodes';
    
    protected $fillable = [
        'tanggal_mulai',
        'tanggal_akhir',
        'durasi_magang',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'periode_id', 'id');
    }
}
