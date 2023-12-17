<?php

namespace Database\Seeders;

use App\Models\food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['MKN01','ROTI','FK01',100,10,1500,2500,8500,14,'EXPAYED',0],
            ['MKN02','SUSU','FK02',100,10,2500,3500,10500,15,'EXPAYED',0],
            ['MKN03','ESKRIM','FK03',100,10,3500,4500,22500,16,'EXPAYED',0],
            ['MKN04','BENG BENG','FK02',100,10,4500,5500,55500,17,'EXPAYED',0],
            ['MKN05','CLUB','FK03',100,10,6500,7500,23500,18,'EXPAYED',0],
            ['MKN06','AQUA','FK02',100,10,5400,6500,42500,19,'EXPAYED',0],
            ['MKN07','TEH GELAS','FK03',100,10,2500,3500,41200,20,'EXPAYED',0],
            // Tambahkan baris data lain di sini jika diperlukan
        ];

        foreach ($data as $item) {
            food::create([
                'kode' => $item[0],
                'nama' => $item[1],
                'foodCategory' => $item[2],
                'qty' => $item[3],
                'safetyStock' => $item[4],
                'hargaBeli' => $item[5],
                'hargaJual' => $item[6],
                'biayaPemesanan' => $item[7],
                'lifeTime' => $item[8],
                'keterangan' => $item[9],
                'penjualan' => $item[10]
                // ... dan seterusnya sesuai dengan field yang ada pada model Item
            ]);
        }
    }
}
