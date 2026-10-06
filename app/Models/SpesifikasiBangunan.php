<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiBangunan extends Model
{
    use HasFactory;

    protected $table = 'spesifikasi_bangunans';

    protected $fillable = [
        'item_type',
        'title',
        'tag',
        'content',
        'checklist',
        'image',
    ];

    public function getChecklistItemsAttribute(): array
    {
        if (empty($this->checklist)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode("\n", $this->checklist))));
    }
}
