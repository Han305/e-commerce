<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    public function scopeFilter($query) {
        if (request('search')) {
            return $query->where('nama', 'like', '%' . request('search') . '%');
        }
    }
    
}