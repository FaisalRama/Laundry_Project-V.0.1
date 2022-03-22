<?php

namespace App\Imports;

use App\Models\tb_paket;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaketImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new tb_paket([
            'id_outlet' => $row['id_outlet'],
            'jenis' => $row['jenis'],
            'nama_paket' => $row['nama_paket'],
            'harga' => $row['harga']
        ]);
    }

    // Digunakan untuk mulai dari baris keberapa proses import akan dimulai
    public function headingRow():int
    {
        return 3;
    }
}
