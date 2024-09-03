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
        User::create([
            'nama' => 'Kesiswaan',
            'email' => 'kesiswaan@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'operator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Reyga Marza Ramadhan',
            'email' => 'rey@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Satria Galam Pratama',
            'email' => 'sat@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Irma Naila Juwita',
            'email' => 'iruma@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Engkus Kusnadi',
            'email' => 'wali10pplg1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Himatul Munawaroh',
            'email' => 'wali11rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Ani Nuraeni',
            'email' => 'wali12rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Yudi Fatir',
            'email' => 'ortu@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Shelomita Madavi',
            'email' => 'ortu2@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Rifa Radwa',
            'email' => 'ortu3@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}