<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodomemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todomembers = 
        [
            [
                'tugas' => 'Menu Penggunaan Barang',
                'keterangan' => 'Isi Keterangan!' 
            ],
            [
                'tugas' => 'Tampilan Halaman Website / Read',
                'keterangan' => 'Isi Keterangan!' 
            ],
            [
                'tugas' => 'Input / Create',
                'keterangan' => 'Isi Keterangan!' 
            ],
            [
                'tugas' => 'Edit / Update',
                'keterangan' => 'Isi Keterangan!' 
            ],
            [
                'tugas' => 'Destroy / Delete',
                'keterangan' => 'Isi Keterangan!' 
            ],
            [
                'tugas' => 'Export Excel',
                'keterangan' => 'Isi Keterangan!' 
            ],
            [
                'tugas' => 'Export PDF',
                'keterangan' => 'Isi Keterangan!' 
            ],
            [
                'tugas' => 'Import Excel',
                'keterangan' => 'Isi Keterangan!' 
            ],
            [
                'tugas' => 'Downlaod Template Excel Untuk Import',
                'keterangan' => 'Isi Keterangan!' 
            ]
        ];

        DB::table('todomembers')->insert($todomembers);
    }
}
