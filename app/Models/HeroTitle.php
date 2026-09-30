<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroTitle extends Model
{
    use HasFactory;

    protected $table = 'hero_titles';

    protected $fillable = [
        'title',
        'deskripsi',
        'image',
        'page',
    ];
}
