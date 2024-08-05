<?php

namespace App\Imports;

use App\Models\Wali_Kelas;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WaliImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $wali = User::where('email', $row['email'])->first();
            if ($wali) {
                $wali->update([
                    'name' => $row['nama'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                    'role' => 'wali'
                ]);

                Wali_Kelas::updateOrCreate(
                    ['id' => $wali->id],
                    [
                    'nuptk' => $row['nuptk'],
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'nip' => $row['nip'],
                ]);
            }else {
                    $user = User::create([
                    'name' => $row['nama'],
                    'email' => $row['email'],
                    'password' => password_hash("12345678", PASSWORD_DEFAULT),
                    'role' => 'wali'
                ]);

                Wali_Kelas::insert([
                    'nuptk' => $row['nuptk'],
                    'id' => $user->id,
                    'jenis_kelamin' => $row['jenis_kelamin'],
                    'nip' => $row['nip'],
                ]);
            }
        }
    }
}
