<?php

namespace App\Imports;

use App\Models\tb_outlet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OutletImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new tb_outlet([
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'tlp' => $row['no_telepon']
        ]);
    }
    
    // Digunakan untuk mulai dari baris keberapa proses import akan dimulai
    public function headingRow():int{
        return 3;
    }
}
