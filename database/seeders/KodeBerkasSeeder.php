<?php

namespace Database\Seeders;

use App\Models\KodeBerkas;
use Illuminate\Database\Seeder;

class KodeBerkasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kode = [
            ['id' => 1, 'nama_kode' => "A001"],
            ['id' => 2, 'nama_kode' => "A002"],
            ['id' => 3, 'nama_kode' => "A003"],
            ['id' => 4, 'nama_kode' => "A004"],
            ['id' => 5, 'nama_kode' => "A005"],
            ['id' => 6, 'nama_kode' => "A006"],
        ];
        foreach ($kode as $item) {
            KodeBerkas::create($item);
        }
    }
}
