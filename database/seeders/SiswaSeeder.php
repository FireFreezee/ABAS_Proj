<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = Kelas::all();
        $jk = ['laki laki', 'perempuan'];

        foreach($kelas as $k)
        {
            for($i = 1; $i <= 30 ; $i++)
            {
                $random = rand(0, 1);
                $no_absen = $i;
                if(strlen($no_absen) == 1)
                {
                    $no_absen = "0$i";
                }

                $nis = $k->id_kelas . $no_absen;
                $nisn = $k->id_kelas . $no_absen;

                $user = User::create([
                    'nama' => fake()->name(),
                    'email' => 'siswa'. $i . strtolower("$k->tingkat$k->id_jurusan$k->nomor_kelas") . '@gmail.com',
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                    'role' => 'siswa',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Siswa::insert([
                    'nis'=> "006$nis$no_absen",
                    'id_user' => $user->id,
                    'jenis_kelamin' => $jk[$random],
                    'nisn' => "002024$nisn",
                    'id_kelas' => $k->id_kelas
                ]);
            }
        }

    }
}
