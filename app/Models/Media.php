<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'title',
        'url',
    ];

    public function getIconClassAttribute(): string
    {
        $title = strtolower($this->title ?? '');
        $url   = strtolower($this->url ?? '');

        if (str_contains($title, 'facebook') || str_contains($url, 'facebook')) {
            return 'fa-brands fa-facebook-f';
        }
        if (str_contains($title, 'instagram') || str_contains($url, 'instagram')) {
            return 'fa-brands fa-instagram';
        }
        if (str_contains($title, 'linkedin') || str_contains($url, 'linkedin')) {
            return 'fa-brands fa-linkedin-in';
        }
        if (str_contains($title, 'tiktok') || str_contains($url, 'tiktok')) {
            return 'fa-brands fa-tiktok';
        }
        if (str_contains($title, 'twitter') || str_contains($title, 'x') || str_contains($url, 'twitter') || str_contains($url, 'x.com')) {
            return 'fa-brands fa-x-twitter';
        }
        if (str_contains($title, 'youtube') || str_contains($url, 'youtube')) {
            return 'fa-brands fa-youtube';
        }
        if (str_contains($title, 'whatsapp') || str_contains($url, 'wa.me')) {
            return 'fa-brands fa-whatsapp';
        }
        if (str_contains($title, 'telegram') || str_contains($url, 't.me')) {
            return 'fa-brands fa-telegram';
        }

        return 'fa-solid fa-share-nodes';
    }
}
