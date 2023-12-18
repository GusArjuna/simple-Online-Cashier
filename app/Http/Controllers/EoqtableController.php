<?php

namespace App\Http\Controllers;

use App\Models\eoqtable;
use App\Http\Requests\StoreeoqtableRequest;
use App\Http\Requests\UpdateeoqtableRequest;
use App\Models\food;
use App\Models\frakturJual;
use App\Models\member;
use App\Models\nomorRegisFrakturBeli;
use App\Models\supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EoqtableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard(){
        $foodCount = food::count();
        $memberCount = member::count();
        $supplierCount = supplier::count();
        $foods = food::orderBy('penjualan','desc')->paginate(15);
        return view("dashboard",[
            "title" => "Dashboard",
            "foodCount" => $foodCount,
            "memberCount" => $memberCount,
            "supplierCount" => $supplierCount,
            "foods" => $foods,
        ]);
    }

    public function index()
    {
        $foods = food::all();
        $eoqTables = eoqtable::query();
        if(request('search')){                                     
            $querytambahan2=food::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get()
                                        ->orWhere('qty','like','%'.request('search').'%')->get()
                                        ->orWhere('safetyStoc','like','%'.request('search').'%')->get()
                                        ->orWhere('lifeTime','like','%'.request('search').'%')->get();
                                        
            $eoqTables->where('kodeMakanan','like','%'.request('search').'%')
                                        ->orWhere('EOQ','like','%'.request('search').'%')
                                        ->orWhere('ROP','like','%'.request('search').'%')
                                        ->orWhere('biayaPenyimpanan','like','%'.request('search').'%');
            
            foreach($querytambahan2 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $eoqTables->orWhere('kodeMakanan','like','%'.$querybantuan.'%');
            }
        }
        return view('EOQMethod/EOQMethod',[
            "title"=>"EOQMethod",
            "eoqTables" => $eoqTables->paginate(15),
            "foods" => $foods,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateEoq(Request $request)
    {
        eoqtable::truncate();
        $year = $request->tahun;
        $foods = food::all();
        $totalDays = 0;
        for ($month = 1; $month <= 12; $month++) {
            $totalDays += cal_days_in_month(CAL_GREGORIAN, $month, $year-1);
        }
        foreach ($foods as $food) {
            $hodingCost = round(($food->hargaJual*$food->qty)/((100/100)+(20/100)),1);
            $demand = frakturJual::where('kodeMakanan','like','%'.$food->kode.'%')
                            ->whereYear('tanggal',$year-1)
                            ->sum('qty');
            $eoq = round(sqrt(2*$food->biayaPemesanan*$demand/$hodingCost),1);
            $rop = round($food->safetyStock*($demand/$totalDays)*$food->lifeTime,1);
            // dd("holding Cost",$hodingCost,
            // "Kode Makanan",$food->kode,
            // "Demand",$demand,
            // "EOQ",$eoq,
            // "SafetyStoc",$food->safetyStock, 
            // "Life Time",$food->lifeTime,
            // "ROP",$rop);

            eoqtable::create([
                'kodeMakanan' => $food->kode,
                'BiayaPenyimpanan' => $hodingCost,
                'EOQ' => $eoq,
                'ROP' => $rop,
                // ... dan seterusnya sesuai dengan field yang ada pada model Item
            ]);
        }
        return redirect('/eoq')->with('success','Data Di Update');
    }
    
    public function printQR($request)
    {
        // // $directory = '../public/qrcodes/';
        // // if (!is_dir($directory)) {
        // //     mkdir($directory, 0777, true);
        // // }
        // // QrCode::format('png');
        // // $qrs=QrCode::generate($request, '../public/qrcodes/',$request,'.png');
        // // dd($qrs);
        // $pdf = Pdf::loadView('printQR', [
        //     "data" => $request,
        //     "qrs" => $qrs,
        // ])->setPaper('f4', 'landscape');
        // return $pdf->download('Print_QR.pdf');
    }

    public function print(Request $request)
    {
        $foods = food::all();
            $cek=false;
            $lastId = eoqtable::orderBy('id', 'desc')->first()->id; // Mendapatkan ID terakhir
            $data = [];
            for ($i = 1; $i <= $lastId; $i++) {
                $inputName = 'print' . $i;
                if($request->$inputName){
                    $cek=true;
                    break;
                }elseif(!$request->$inputName){
                    $cek=false;
                }
            }
            if($cek){
                for ($i = 1; $i <= $lastId; $i++) {
                    $inputName = 'print' . $i; // Membuat nama input berdasarkan iterasi
    
                    if ($request->has($inputName)) {
                        // Melakukan pencarian berdasarkan nilai input dari request pada model barangKeluar
                        $foundMaterial = eoqtable::find($request->$inputName);
    
                        if ($foundMaterial) {
                            $data[] = $foundMaterial; // Menambahkan model yang cocok ke dalam array $data
                        }
                    }
                }
                $pdf = Pdf::loadView('stuffoutf.pdf', [
                    "foods" => $foods,
                    "eoqtables" => $data
                ])->setPaper('f4', 'landscape');
                return $pdf->download('Laporan_Barang_Keluar.pdf');
            }else{
                $eoqtables = eoqtable::query();
                if($request->search){
                    $querytambahans=food::where('peruntukan','like','%'.request('search').'%')
                                        ->orWhere('namaMaterial','like','%'.request('search').'%')
                                        ->orWhere('satuan','like','%'.request('search').'%')->get();
                                        
                    $eoqtables->where('kodeMaterial','like','%'.request('search').'%')
                                                ->orWhere('jumlah','like','%'.request('search').'%')
                                                ->orWhere('kondisi','like','%'.request('search').'%')
                                                ->orWhere('keterangan','like','%'.request('search').'%')
                                                ->orWhere('keperluan','like','%'.request('search').'%')
                                                ->orWhere('keterangan','like','%'.request('search').'%')
                                                ->orWhere('peminjam','like','%'.request('search').'%')
                                                ->orWhere('divisi','like','%'.request('search').'%')
                                                ->orWhere('tanggalKeluar','like','%'.request('search').'%');
                    
                    foreach($querytambahans as $querytambahan){
                        $querybantuan= (string)$querytambahan->kodeMaterial;
                        $eoqtables->orWhere('kodeMaterial','like','%'.$querybantuan.'%');
                    }
                }
                $foods = $foods->toArray();
                $eoqtables = $eoqtables->get()->toArray();
                $pdf = Pdf::loadView('EOQMethod.EOQMethodPrint', [
                    "foods" => $foods,
                    "eoqtables" => $eoqtables
                ])->setPaper('f4', 'landscape');
                return $pdf->download('EOQMethod.pdf');
            } 
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreeoqtableRequest $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(eoqtable $eoqtable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(eoqtable $eoqtable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeoqtableRequest $request, eoqtable $eoqtable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(eoqtable $eoqtable)
    {
        //
    }
}
