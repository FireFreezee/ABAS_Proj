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
        'nik_ayah',
        'nik_ibu',
        'nik_wali',
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
        return $this->hasMany(Absensi::class, 'nis', 'nis');
    }

    // Relationship for Ayah
    public function ayah()
    {
        return $this->belongsTo(Wali_Siswa::class, 'nik_ayah', 'nik');
    }

    // Relationship for Ibu
    public function ibu()
    {
        return $this->belongsTo(Wali_Siswa::class, 'nik_ibu', 'nik');
    }

    // Relationship for Wali
    public function wali()
    {
        return $this->belongsTo(Wali_Siswa::class, 'nik_wali', 'nik');
    }

    public $timestamps = false;
}
