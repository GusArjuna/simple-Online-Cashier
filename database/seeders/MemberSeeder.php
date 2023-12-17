<?php

namespace Database\Seeders;

use App\Models\member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['MBR01','PAK ROSYID','08767676','JLJL','ACTIVE','BAHAN POKOK'],
            ['MBR02','PAK ARJUNA','08767676','JLJL','ACTIVE','BAHAN POKOK'],
            ['MBR03','PAK DOVAN','08767676','JLJL','ACTIVE','BAHAN POKOK'],
            ['MBR04','PAK HER','08767676','JLJL','ACTIVE','BAHAN POKOK'],
            ['MBR05','PAK SEN','08767676','JLJL','ACTIVE','BAHAN POKOK'],
            ['MBR06','PAK PAR','08767676','JLJL','ACTIVE','BAHAN POKOK']
            // Tambahkan baris data lain di sini jika diperlukan
        ];

        foreach ($data as $item) {
            member::create([
                'kode' => $item[0],
                'nama' => $item[1],
                'noTelp' => $item[2],
                'alamat' => $item[3],
                'status' => $item[4],
                'keterangan' => $item[5]
                // ... dan seterusnya sesuai dengan field yang ada pada model Item
            ]);
        }
    }
}
