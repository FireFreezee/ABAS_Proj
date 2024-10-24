<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali_Kelas extends Model
{
    use HasFactory;

    // protected $table = 'wali__kelas';
    public $primaryKey = 'nip';

    protected $fillable = [
        'nip',
        'id_user',
        'jenis_kelamin',
        'nuptk',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'nip', 'nip');
    }

    public function jurusan()
    {
        return $this->hasOneThrough(jurusan::class, kelas::class, 'nip', 'id_jurusan', 'nip', 'id_jurusan');
    }

    public $timestamps = false;
}
