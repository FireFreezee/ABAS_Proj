<?php

namespace App\Imports;


use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Kelas;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelasImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        // Define the valid ENUM values for 'tingkat' as strings
        $validTingkatValues = ['10', '11', '12']; // Adjust based on your actual ENUM values

        foreach ($rows as $row) {
            // Find the Jurusan by 'id_jurusan'
            $jurusan = Jurusan::where('id_jurusan', $row['id_jurusan'])->first();
            $jurusanId = $jurusan ? $jurusan->id_jurusan : null;

            // Check if the Jurusan ID exists and is valid
            if ($jurusanId) {
                // Validate 'tingkat' against ENUM values
                $tingkatValue = (string) $row['tingkat']; // Convert to string for comparison

                if (in_array($tingkatValue, $validTingkatValues)) {
                    // Check if the Kelas already exists
                    $kelas = Kelas::where('nomor_kelas', $row['nomor_kelas'])
                                ->where('id_jurusan', $jurusanId)
                                ->first();

                    if ($kelas) {
                        // Update existing Kelas
                        $kelas->update([
                            'tingkat' => $tingkatValue, // Ensure valid ENUM value
                        ]);
                    } else {
                        // Create new Kelas with validated ENUM value
                        $kelas = Kelas::create([
                            'nomor_kelas' => $row['nomor_kelas'],
                            'id_jurusan' => $jurusanId,
                            'tingkat' => $tingkatValue, // Ensure valid ENUM value
                        ]);
                    }
                    // Check if the User already exists
                    $user = User::where('email', $row['email'])->first();
                    if ($user) {
                        // Update existing User
                        $user->update([
                            'nama' => $row['nama'],
                            'password' => password_hash("12345678", PASSWORD_DEFAULT), // Optional: only update password if needed
                        ]);
                    } else {
                        // Create new User
                        $user = User::create([
                            'nama' => $row['nama'],
                            'email' => $row['email'],
                            'password' => password_hash("12345678", PASSWORD_DEFAULT),
                            'role' => 'siswa'
                        ]);
                    }

                    // Check if the Siswa already exists
                    $siswa = Siswa::where('nis', $row['nis'])->first();
                    if ($siswa) {
                        // Update existing Siswa
                        $siswa->update([
                            'id_user' => $user->id,
                            'id_kelas' => $kelas->id_kelas,
                            'jenis_kelamin' => $row['jenis_kelamin'],
                            'nisn' => $row['nisn'],
                        ]);
                    } else {
                        // Create new Siswa
                        Siswa::create([
                            'nis' => $row['nis'],
                            'id_user' => $user->id,
                            'id_kelas' => $kelas->id_kelas,
                            'jenis_kelamin' => $row['jenis_kelamin'],
                            'nisn' => $row['nisn'],
                        ]);
                    }
                    // User and Siswa creation/update logic remains the same...
                } else {
                    // Handle invalid 'tingkat' values
                    return redirect()->back()->with('failed', 'Invalid tingkat value: ' . $tingkatValue);
                }
            } else {
                // Handle cases where Jurusan does not exist
                return redirect()->back()->with('failed', 'Jurusan not found for ID: ' . $row['id_jurusan']);
            }
        }    
    }
}

