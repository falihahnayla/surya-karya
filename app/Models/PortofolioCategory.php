<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortofolioCategory extends Model
{
    use HasFactory;

    protected $table = 'portofolio_categories';

    protected $fillable = [
        'title',
    ];

    public function portofolios()
    {
        return $this->hasMany(Portofolio::class, 'category_id');
    }
}
