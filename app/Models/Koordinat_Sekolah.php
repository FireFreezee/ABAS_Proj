<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koordinat_Sekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'lokasi_sekolah',
        'radius',
    ];

    public function koordinat()
    {
        return $this->hasMany(Absensi::class, 'id_koordinat_sekolah');
    }
}
