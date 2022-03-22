<?php

namespace App\Imports;

use App\Models\jemputlaundry;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjemputanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new jemputlaundry([
            'id_member' => $row['id_member'],
            'petugas_penjemput' => $row['nama_petugas_penjemputan'],
            'status' => $row['status']
        ]);
    }

    public function headingRow():int{
        return 3;
    }
}
