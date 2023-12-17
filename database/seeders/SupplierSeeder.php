<?php

namespace Database\Seeders;

use App\Models\supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['SPL01','ROSYID','08767676','JLJL','BAHAN POKOK'],
            ['SPL02','ARJUNA','08767676','JLJL','BAHAN POKOK'],
            ['SPL03','DOVAN','08767676','JLJL','BAHAN POKOK'],
            ['SPL04','HER','08767676','JLJL','BAHAN POKOK'],
            ['SPL05','SEN','08767676','JLJL','BAHAN POKOK'],
            ['SPL06','PAR','08767676','JLJL','BAHAN POKOK']
            // Tambahkan baris data lain di sini jika diperlukan
        ];

        foreach ($data as $item) {
            supplier::create([
                'kode' => $item[0],
                'nama' => $item[1],
                'noTelp' => $item[2],
                'alamat' => $item[3],
                'keterangan' => $item[4]
                // ... dan seterusnya sesuai dengan field yang ada pada model Item
            ]);
        }
    }
}
