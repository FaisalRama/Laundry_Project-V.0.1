<?php

namespace App\Exports;

use App\Models\tb_member;
use Maatwebsite\Excel\Concerns\FromCollection;

class MemberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tb_member::all();
    }
}
