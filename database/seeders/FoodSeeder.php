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
            ['MKN01','ROTI','FK01',100,10,1500,2500,8500,14,'makanan',0,0],
            ['MKN02','SUSU','FK02',100,10,2500,3500,10500,15,'makanan',0,0],
            ['MKN03','ESKRIM','FK03',100,10,3500,4500,22500,16,'makanan',0,0],
            ['MKN04','BENG BENG','FK02',100,10,4500,5500,55500,17,'makanan',0,0],
            ['MKN05','CLUB','FK03',100,10,6500,7500,23500,18,'makanan',0,0],
            ['MKN06','AQUA','FK02',100,10,5400,6500,42500,19,'makanan',0,0],
            ['MKN07','TEH GELAS','FK03',100,10,2500,3500,41200,20,'makanan',0,0],
            ['FRZ001','Kanzler Beef Cocktail Sausage','FK01',10,5,30000,36000,500,7,'SOSIS',0,0],
            ['FRZ002','Kanzler Sosis Chees Frankfurter','FK01',10,5,35500,41000,500,7,'SOSIS',0,0],
            ['FRZ003','Champ Sosis Ayam 375 grm','FK01',10,5,12000,17000,500,7,'SOSIS',0,0],
            ['FRZ004','Sosis Bakar Vigo isi 12 pcs 500 grm','FK01',10,5,19000,25000,500,7,'SOSIS',0,0],
            ['FRZ005','Sosis Bernardi Horeca Park 1 kg','FK01',10,5,55000,59900,500,7,'SOSIS',0,0],
            ['FRZ006','Bernardi Sosis Sapi Breakfast Horeca','FK01',10,5,60000,64000,500,7,'SOSIS',0,0],
            ['FRZ007','Kimbo Sosis Bratwurst','FK01',10,5,21500,27500,500,7,'SOSIS',0,0],
            ['FRZ008','Sosis Ayam Metzger Halal','FK01',10,5,69500,75500,500,7,'SOSIS',0,0],
            ['FRZ009','Kanzler Crispy Chicken Nugget','FK01',10,3,36500,40000,500,7,'NUGGET',0,0],
            ['FRZ010','SoEco Nugget','FK01',10,3,15500,20000,500,7,'NUGGET',0,0],
            ['FRZ011','So Good Chicken Nugget Dinobites','FK01',10,3,39500,44500,500,7,'NUGGET',0,0],
            ['FRZ012','Naget Ayam Chicken Nugget','FK01',10,3,15500,19500,500,7,'NUGGET',0,0],
            ['FRZ013','Nugget Champ 250 grm','FK01',10,3,13000,18000,500,7,'NUGGET',0,0],
            ['FRZ014','Fiesta Chicken Nugget Cheese Garlic','FK01',10,3,28500,32500,500,7,'NUGGET',0,0],
            ['FRZ015','So Good Chicken Nugget Alphabet','FK01',10,3,40000,45900,500,7,'NUGGET',0,0],
            ['FRZ016','Salam Nugget Ayam 250 grm','FK01',10,3,7500,10500,500,7,'NUGGET',0,0],
            ['FRZ017','Kentang Crinkle Cut 2,5 kg','FK01',10,3,66000,70000,500,7,'Kentang',0,0],
            ['FRZ018','Golden Farm French Fries 1 kg','FK01',10,3,30500,35500,500,7,'Kentang',0,0],
            ['FRZ019','Just Fry Kentang Goreng Shoestring 450 gr','FK01',10,3,14500,18500,500,7,'Kentang',0,0],
            ['FRZ020','Just Fry Kentang Berbumbu 450 gr','FK01',10,3,22900,26900,500,7,'Kentang',0,0],
            ['FRZ021','Fiesta Kentang Goreng 500 gr','FK01',10,3,15900,19900,500,7,'Kentang',0,0],
            ['FRZ022','Bellfoods Kentang Goreng 500 gr','FK01',10,3,20500,23700,500,7,'Kentang',0,0],
            ['FRZ023','Kentang Goreng Aviko Shoestring 2,5 kg','FK01',10,3,61500,66500,500,7,'Kentang',0,0],
            ['FRZ024','Oden (Baso Ikan Korea/Fishcake)','FK01',10,5,51500,55000,500,7,'Fish Cake',0,0],
            ['FRZ025','Cedea Otak-otak Ikan','FK01',10,5,51000,55000,500,7,'Fish Cake',0,0],
            ['FRZ026','Halal Mu Gung Hwa Fishcake','FK01',10,5,33500,38000,500,7,'Fish Cake',0,0],
            ['FRZ027','Odeng Hotbar Odeng Tusuk','FK01',10,5,27500,32000,500,7,'Fish Cake',0,0],
            ['FRZ028','Kibun Narutomaki (Fishcake Naruto)','FK01',10,5,29000,35000,500,7,'Fish Cake',0,0],
            ['FRZ029','Cedea Fishcake Singapore','FK01',10,5,27000,31000,500,7,'Fish Cake',0,0],
            ['FRZ030','Cedea Crab Stick','FK01',10,5,15500,19500,500,7,'Fish Cake',0,0],
            ['FRZ031','Daitsabu Crab Stick','FK01',10,5,23000,28000,500,7,'Fish Cake',0,0],
            ['FRZ032','Crab Stick Mr Ho 450 grm','FK01',10,5,31400,36000,500,7,'Fish Cake',0,0],
            ['FRZ033','Chikuwa Mini Cedea  500 grm','FK01',10,5,24000,28500,500,7,'Fish Cake',0,0],
            ['JAM001','Jamu beras kencur 250 ml','FK02',15,5,4000,6500,500,7,'minuman jamu',0,0],
            ['JAM002','jamu sinom 250  ml','FK02',15,5,4000,6500,500,7,'minuman jamu',0,0],
            ['JAM003','jamu suruh 250 ml','FK02',15,5,4000,6500,500,7,'minuman jamu',0,0],
            ['JAM004','jamu kunyit asam 250 ml','FK02',15,5,4000,6500,500,7,'minuman jamu',0,0],
            ['MIK001','floridina 350 ml','FK03',48,5,2000,3000,500,7,'minuman',0,0],
            ['MIK002','pokari sweat 500 ml','FK03',48,5,6500,8000,500,7,'minuman',0,0],
            ['MIK003','ultramilk UHT 250 ml','FK03',48,5,6000,7500,500,7,'minuman',0,0],
            ['MIK004','aqua air mineral 600 ml','FK03',48,5,1500,4000,500,7,'minuman',0,0],
            ['MIK005','adem sari chingku lemon 350 ml','FK03',48,5,7500,9500,500,7,'minuman',0,0],
            ['MIK006','JAVANA melati 350 ml','FK03',48,5,2500,3500,500,7,'minuman',0,0],
            ['MIK007','Fruit tea freeze 350 ml','FK03',48,5,3000,4000,500,7,'minuman',0,0],
            ['ICE001','campina hula hula kacang hijau 45 ml','FK04',25,5,2500,4500,500,12,'ice cream',0,0],
            ['ICE002','campuina cream choco vanila 65 ml','FK04',25,5,4000,5500,500,12,'ice cream',0,0],
            ['ICE003','walls feast vanilla 65 ml','FK04',25,5,4500,6500,500,12,'ice cream',0,0],
            ['ICE004','walls feast chocolate 65 ml','FK04',25,5,3500,5000,500,12,'ice cream',0,0],
            ['ICE005','walls populaire strowberry vanilla 90 ml','FK04',25,5,4000,5500,500,12,'ice cream',0,0],
            ['ICE006','walls populaire ch0colate vanilla 90 ml','FK04',25,5,4000,5500,500,12,'ice cream',0,0],
            ['ICE007','walls conetto oreo 110 ml','FK04',25,5,9000,13500,500,12,'ice cream',0,0],
            ['ICE008','walls conetto bold cookies 80 ml','FK04',25,5,3000,5500,500,12,'ice cream',0,0],
            ['ICE009','walls conetto black dan white  80 ml','FK04',25,5,4500,6500,500,12,'ice cream',0,0],
            ['ICE010','aice chocolate almond 90 ml','FK04',25,5,9000,11500,500,12,'ice cream',0,0],
            ['ICE011','aice sweet corn 52 ml','FK04',25,5,2000,4500,500,12,'ice cream',0,0],
            ['ICE012','aice histeria vanila 70 ml','FK04',25,5,7000,9500,500,12,'ice cream',0,0],
            ['ICE013','aice chocolate crispy 60 ml','FK04',25,5,3000,7500,500,12,'ice cream',0,0],
            ['ICE014','aice mango slush 65 g','FK04',25,5,2500,7000,500,12,'ice cream',0,0],

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
                'penjualan' => $item[10],
                'pembelian' => $item[11],
                // ... dan seterusnya sesuai dengan field yang ada pada model Item
            ]);
        }
    }
}
