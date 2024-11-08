<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function todo(){
        return $this->belongsTo(Todo::class, 'todo_id');
    }
    public function hasil(){
        return $this->belongsTo(Hasil_mentoring::class, 'hasil_id');
    }
    public function materi(){
        return $this->belongsTo(Materi_mentoring::class, 'materi_id');
    }
    protected $fillable = [
        'tanggal_mentoring',
        'jam_mentoring',
        'status',
        'todo_id',
        'user_id',
        'mentor_id',
        'materi_id',
        'hasil_id'
    ];
}
