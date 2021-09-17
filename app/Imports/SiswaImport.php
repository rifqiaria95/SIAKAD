<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);
        foreach ($collection as $key => $col)
        {
            if($key >= 3)
            {
                // $tanggal_lahir = ($col[5] - 25569) * 86400;
                Siswa::create([
                    'user_id' => '999',
                    'nama_depan' => $col[0],
                    'nama_belakang' => $col[1],
                    'jenis_kelamin' => $col[2],
                    'agama' => $col[3],
                    'alamat' => $col[4],
                    // 'tgl_lahir' => gmdate('Y-m-d', $tanggal_lahir),
                ]);
            }
        }
    }
}
