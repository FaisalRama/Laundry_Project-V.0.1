<?php

namespace App\Imports;

use App\Models\tb_member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MemberImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new tb_member([
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tlp' => $row['no_telepon']
        ]);
    }

    public function headingRow():int{
        return 3;
    }
}
