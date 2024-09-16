<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Tambahkan nama tabel jika berbeda dengan pluralisasi default
    // protected $table = 'categories';

    // Tentukan atribut yang dapat diisi secara massal
    protected $fillable = ['name'];

    // Jika ada atribut yang tidak bisa diisi secara massal, bisa ditentukan di sini
    // protected $guarded = [];
}
