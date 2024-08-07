<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';
    public $primaryKey = 'id_jurusan';
    public $incrementing = false;
    protected $keyType = 'string';

    
    protected $fillable = [
        'id_jurusan',
        'nama_jurusan'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class ,'id_jurusan');
    }

    public $timestamps = false;
}
