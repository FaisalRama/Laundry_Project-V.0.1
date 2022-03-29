<?php

namespace App\Imports;

use App\Models\penggunaanbarang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenggunaanBarangImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $waktu_pakai =  date('Y-m-d H:i:s', ($row['waktu_dipakai'] - 25569) * 86400);
        // $waktu_beres =  date('Y-m-d H:i:s', ($row['waktu_beres'] - 25569) * 86400);

        return new penggunaanbarang([
            'nama_barang' => $row['nama_barang'],
            'waktu_pakai' => $row['waktu_dipakai'],
            'waktu_beres' => $row['waktu_beres'],
            'nama_pemakai' => $row['nama_pemakai'],
            'status' => $row['status']
        ]);
    }

    public function headingRow():int{
        return 3;
    }
}
