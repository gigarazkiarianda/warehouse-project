<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'deskripsi', 'harga', 'stok', 'gudang_id'];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}

