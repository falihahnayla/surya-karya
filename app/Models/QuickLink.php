<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickLink extends Model
{
    protected $table = 'quick_links';

    protected $fillable = ['title', 'url'];

    /**
     * URL siap pakai di footer.
     * "/faq" -> https://domainmu.com/faq, sedangkan "https://..." dibiarkan apa adanya.
     */
    public function getHrefAttribute(): string
    {
        return str_starts_with($this->url, '/') ? url($this->url) : $this->url;
    }

    /** True kalau link mengarah ke website lain (dibuka di tab baru). */
    public function getIsExternalAttribute(): bool
    {
        return ! str_starts_with($this->url, '/');
    }
}