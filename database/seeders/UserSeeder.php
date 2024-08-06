<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user::create([
            'id_user' => 'K001',
            'name' => 'Kesiswaan',
            'email' => 'kesiswaan@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'S001',
            'name' => 'Reyga Marza Ramadhan',
            'email' => 'rey@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'S002',
            'name' => 'Satria Galam Pratama',
            'email' => 'sat@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'S003',
            'name' => 'Irma Naila Juwita',
            'email' => 'iruma@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'WK001',
            'name' => 'Engkus Kusnadi',
            'email' => 'wali10pplg1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'WK002',
            'name' => 'Himatul Munawaroh',
            'email' => 'wali11rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'WK003',
            'name' => 'Ani Nuraeni',
            'email' => 'wali12rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'OP001',
            'name' => 'Operator1',
            'email' => 'opabas@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'operator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'WS001',
            'name' => 'Cahyadi',
            'email' => 'cahyadi@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'WS002',
            'name' => 'Asep',
            'email' => 'Asep@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        user::create([
            'id_user' => 'WS003',
            'name' => 'Saepuloh',
            'email' => 'saepuloh@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
