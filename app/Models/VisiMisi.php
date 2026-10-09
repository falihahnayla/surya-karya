<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misi';

    protected $fillable = [
        'visi_title',
        'visi_content',
        'misi_title',
        'misi_content',
    ];
}