<?php

namespace App\Exports;

use App\Models\tb_paket;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaketExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tb_paket::all();
    }
}
