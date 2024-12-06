<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'eventos'; 

    // Campos que podem ser preenchidos em massa
    protected $fillable = ['title', 'date', 'image', 'details'];
}
