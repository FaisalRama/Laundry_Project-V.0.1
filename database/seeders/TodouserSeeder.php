<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodouserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todouser = 
        [
            [
                'tugas' => 'Menu User',
                'check' => 0,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Tampilan Halaman Website / Read',
                'check' => 0,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Input / Create',
                'check' => 0,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Edit / Update',
                'check' => 0,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Destroy / Delete',
                'check' => 0,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Export Excel',
                'check' => 0,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Export PDF',
                'check' => 0,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Import Excel',
                'check' => 0,
                'keterangan' => 'DONE, AMAN' 
            ],
            [
                'tugas' => 'Downlaod Template Excel Untuk Import',
                'check' => 0,
                'keterangan' => 'Isi Keterangan!' 
            ]
        ];

        DB::table('todousers')->insert($todouser);
    }
}
