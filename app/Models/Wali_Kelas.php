<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali_Kelas extends Model
{
    use HasFactory;

    // protected $table = 'wali__kelas';

    protected $fillable = [
        'nuptk',
        'id_user',
        'jenis_kelamin',
        'nip',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'nuptk', 'nuptk');
    }

    public function jurusan()
    {
        return $this->hasOneThrough(jurusan::class, kelas::class, 'nuptk', 'id_jurusan', 'nuptk', 'id_jurusan');
    }

    public $timestamps = false;
}
