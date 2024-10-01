<?php

// app/Models/Biodata.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'nomor_hp', 'user_id'
    ];


    protected $table = 'biodatas';
}

