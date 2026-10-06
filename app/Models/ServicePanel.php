<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePanel extends Model
{
    use HasFactory;

    protected $table = 'service_panels';

    protected $fillable = [
        'panel_key',
        'eyebrow',
        'title',
        'deskripsi',
        'image',
    ];

    public static function getForKey(string $key): ?self
    {
        return self::where('panel_key', $key)->first();
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

    public function getFormattedTitleAttribute(): string
    {
        $title = $this->title ?? '';
        if (str_contains($title, '<span')) {
            return $title;
        }

        if (strtolower($title) === 'pembangunan') {
            return 'Pembang<span class="italic font-light text-[#dfcfb9]">unan</span>';
        }
        if (strtolower($title) === 'renovasi') {
            return 'Reno<span class="italic font-light text-[#dfcfb9]">vasi</span>';
        }

        $parts = explode(' ', trim($title), 2);
        if (count($parts) === 2) {
            return e($parts[0]) . ' <span class="italic font-light text-[#dfcfb9]">' . e($parts[1]) . '</span>';
        }

        return e($title);
    }
}
