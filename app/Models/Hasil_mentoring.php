<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil_mentoring extends Model
{
    use HasFactory;
    public function todo(){
        return $this->belongsTo(Todo::class, 'todo_id');
    }
    public function jadwal(){
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
    protected $fillable = [
        'hasil',
        'feedback',
        'todo_id'
    ];
}
