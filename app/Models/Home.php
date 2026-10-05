<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image_bg',
        'image_about',
        'content_about',
        'img_desc',
        'service_title',
        'service_desc',
    ];
}