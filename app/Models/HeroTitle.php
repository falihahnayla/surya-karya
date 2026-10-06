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

    public static function getForPage(string $page): ?self
    {
        return self::where('page', $page)->first();
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        return asset($this->image);
    }
}
