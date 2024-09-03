<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu_Absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'jam_absen',
        'batas_absen_masuk',
        'jam_pulang',
        'batas_absen_pulang'
    ];

    public function waktu_absen()
    {
        return $this->hasMany(Absensi::class, 'id_waktu_absen');
    }

    public $timestamps = false;
}
