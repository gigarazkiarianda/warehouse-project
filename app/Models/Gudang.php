<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'lokasi', 'kapasitas'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
