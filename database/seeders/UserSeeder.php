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
            'id' => '1',
            'name' => 'Kesiswaan',
            'email' => 'kesiswaan@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
        ]);

        user::create([
            'id' => '2',
            'name' => 'Reyga Marza Ramadhan',
            'email' => 'rey@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
        ]);

        user::create([
            'id' => '3',
            'name' => 'Satria Galam Pratama',
            'email' => 'sat@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
        ]);

        user::create([
            'id' => '4',
            'name' => 'Irma Naila Juwita',
            'email' => 'iruma@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',


        ]);

        user::create([
            'id' => '5',
            'name' => 'Engkus Kusnadi',
            'email' => 'wali10pplg1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
        ]);

        user::create([
            'id' => '6',
            'name' => 'Himatul Munawaroh',
            'email' => 'wali11rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
        ]);

        user::create([
            'id' => '7',
            'name' => 'Ani Nuraeni',
            'email' => 'wali12rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
        ]);

        user::create([
            'id' => '8',
            'name' => 'Operator1',
            'email' => 'opabas@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'operator',
        ]);

        user::create([
            'id' => '9',
            'name' => 'Cahyadi',
            'email' => 'cahyadi@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
        ]);

        user::create([
            'id' => '10',
            'name' => 'Asep',
            'email' => 'Asep@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
        ]);

        user::create([
            'id' => '11',
            'name' => 'Saepuloh',
            'email' => 'saepuloh@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
        ]);
    }
}
