<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil_mentoring extends Model
{
    use HasFactory;
    protected $fillable = [
        'hasil',
        'feedback',
        'jadwal_id',
        'todo_id'
    ];
}
