<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal_mentoring',
        'jam_mentoring',
        'status',
        'todo_id',
        'user_id',
        'mentor_id',
        'materi_id'
    ];
}
