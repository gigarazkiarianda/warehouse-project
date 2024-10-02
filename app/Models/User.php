<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gudang_id',
        'roles',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Mengambil Gudang yang terkait dengan pengguna.
     */
    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    /**
     * Menampilkan biodata pengguna.
     */
    public function biodata()
{
    return $this->hasOne(Biodata::class);
}

    /**
     * Memeriksa apakah pengguna memiliki role tertentu.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->roles === $role;
    }
}
