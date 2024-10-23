<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'to_do';
    use HasFactory;
    protected $fillable = [
        'todo',
        'tipe_todo'
    ];
}
