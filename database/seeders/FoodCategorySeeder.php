<?php

namespace Database\Seeders;

use App\Models\foodCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['FK01','BAHAN POKOK','EXP 2 Bulan'],
            ['FK02','SANDANG','EXP 3 Bulan'],
            ['FK03','PANGAN','EXP 4 Bulan'],
            ['FK04','PEDA','EXP 5 Bulan'],
            ['FK05','MOBIL','EXP 6 Bulan'],
            ['FK06','BAJU POKOK','EXP 7 Bulan']
            // Tambahkan baris data lain di sini jika diperlukan
        ];

        foreach ($data as $item) {
            foodCategory::create([
                'kode' => $item[0],
                'nama' => $item[1],
                'keterangan' => $item[2]
                // ... dan seterusnya sesuai dengan field yang ada pada model Item
            ]);
        }
    }
}
