<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi_mentoring extends Model
{
    use HasFactory;
    protected $fillable = [
        'materi',
        'description'
    ];
}
