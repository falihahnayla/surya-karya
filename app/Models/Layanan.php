<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    protected $table = 'layanan';

    protected $fillable = ['title'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'layanan_id');
    }
}