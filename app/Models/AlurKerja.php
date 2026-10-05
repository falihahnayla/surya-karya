<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlurKerja extends Model
{
    protected $table = 'alur_kerja';

    protected $fillable = [
        'no',
        'title',
        'content',
        'image',
    ];
}