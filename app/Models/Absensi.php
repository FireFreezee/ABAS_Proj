<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'status',
        'bukti',
        'date',
        'jam_masuk',
        'jam_pulang',
        'titik_koordinat',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function koordinat()
    {
        return $this->belongsTo(Koordinat_Sekolah::class, 'id_koordinat_sekolah');
    }

    public $timestamps = false;

}
