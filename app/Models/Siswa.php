<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nis',
        'id_user',
        'id_kelas',
        'nik',
        'jenis_kelamin',
        'nisn',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'NIS');
    }

    public function ortu()
    {
        return $this->hasOne(Wali_Siswa::class, 'nik', 'nik');
    }

    public $timestamps = false;
}
