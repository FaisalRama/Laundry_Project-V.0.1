<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(TodomemberSeeder::class);
        $this->call(TodooutletSeeder::class);
        $this->call(TodopaketSeeder::class);
        $this->call(TodopenjemputanLaundrySeeder::class);
        $this->call(TododatabarangSeeder::class);
        $this->call(TodopenggunaanBarangSeeder::class);
        $this->call(TodoabsensiKerjaKaryawanSeeder::class);
        $this->call(TodobarangInventarisSeeder::class);
        $this->call(TodouserSeeder::class);
    }
}
