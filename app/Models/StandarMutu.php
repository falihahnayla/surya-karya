<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandarMutu extends Model
{
    use HasFactory;

    protected $table = 'standar_mutus';

    protected $fillable = [
        'title',
        'content',
    ];
}
