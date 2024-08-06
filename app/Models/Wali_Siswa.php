<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali_Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'id_user',
        'jenis_kelamin',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'nik', 'nik');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }

    public $timestamps = false;
}
