<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiBangunan extends Model
{
    use HasFactory;

    protected $table = 'spesifikasi_bangunans';

    protected $fillable = [
        'title',
        'content',
    ];
}
