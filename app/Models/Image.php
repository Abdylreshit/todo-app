<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'todo_id'
    ];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
