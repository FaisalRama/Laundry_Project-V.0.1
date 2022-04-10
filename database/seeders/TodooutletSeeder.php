<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodooutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todooutlet = 
        [
            [
                'tugas' => 'Menu Outlet',
                'check' => 1,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Tampilan Halaman Website / Read',
                'check' => 1,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Input / Create',
                'check' => 1,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Edit / Update',
                'check' => 1,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Destroy / Delete',
                'check' => 1,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Export Excel',
                'check' => 1,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Export PDF',
                'check' => 1,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Import Excel',
                'check' => 1,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Downlaod Template Excel Untuk Import',
                'check' => 1,
                'keterangan' => 'Isi Keterangan!' 
            ]
        ];

        DB::table('todooutlets')->insert($todooutlet);
    }
}
