<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali_Siswa extends Model
{
    use HasFactory;

    public $primaryKey = 'nik';

    protected $fillable = [
        'nik',
        'id_user',
        'jenis_kelamin',
    ];

    public function nik_ayah()
    {
        return $this->hasMany(Siswa::class, 'nik_ayah', 'nik');
    }

    public function nik_ibu()
    {
        return $this->hasMany(Siswa::class, 'nik_ibu', 'nik');
    }

    public function nik_wali()
    {
        return $this->hasMany(Siswa::class, 'nik_wali', 'nik');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public $timestamps = false;
}
