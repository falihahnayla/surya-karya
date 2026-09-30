<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $table = 'portofolios';

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'location',
        'image',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(PortofolioCategory::class, 'category_id');
    }
}
