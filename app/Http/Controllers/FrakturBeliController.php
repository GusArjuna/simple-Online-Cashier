<?php

namespace App\Http\Controllers;

use App\Models\frakturBeli;
use App\Http\Requests\StorefrakturBeliRequest;
use App\Http\Requests\UpdatefrakturBeliRequest;
use App\Models\food;
use App\Models\member;
use App\Models\nomorRegisFrakturBeli;
use App\Models\supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FrakturBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = supplier::all();
        $buyFracturenumbers = nomorRegisFrakturBeli::query();
        if(request('search')){                                     
            $querytambahan1=supplier::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
                                        
            $buyFracturenumbers->where('kode','like','%'.request('search').'%')
                                        ->orWhere('kodeSupplier','like','%'.request('search').'%')
                                        ->orWhere('qty','like','%'.request('search').'%')
                                        ->orWhere('harga','like','%'.request('search').'%')
                                        ->orWhere('total','like','%'.request('search').'%')
                                        ->orWhere('tanggal','like','%'.request('search').'%');
            
            foreach($querytambahan1 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $buyFracturenumbers->orWhere('kodeSupplier','like','%'.$querybantuan.'%');
            }
        }
        return view('buyFractures/buyFracture',[
            "title"=>"Fraktur Beli",
            "buyFracturenumbers" => $buyFracturenumbers->paginate(15),
            "suppliers" => $suppliers,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nomorRegis = nomorRegisFrakturBeli::latest()->first()->id??false;
        if($nomorRegis){
            $nomorRegis = 'BFR'.($nomorRegis+1);
        }else{
            $nomorRegis = 'BFR1';
        }
        $foods = food::all();
        $suppliers = supplier::all();
        return view('buyFractures/buyFractureIn',[
            "title"=>"Tambah Fraktur Beli",
            "foods" => $foods,
            "suppliers" => $suppliers,
            "nomorRegis" => $nomorRegis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefrakturBeliRequest $request)
    {
        $validatedData = $request->validate([
            'nomorRegis' => 'required',
            'supplier' => 'required',
            'food.*' => 'required',
            'qty.*' => 'required',
            'totalKeseluruhan' => 'required',
            'tanggal' => 'required',
            'harga.*' => 'required',
            'total.*' => 'required',
        ]);          
       for ($i=0; $i < count($request->qty); $i++) { 
            $food = food::query()->where('kode','like','%'.$validatedData['food'][$i].'%')->get()->first();
            $newQty = $food->qty + intval($validatedData['qty'][$i]);
            food::where('id',$food->id)
                    ->update(['qty'=> $newQty]);
           
            frakturBeli::create([
                'kodeTransaksi' => $validatedData['nomorRegis'],
                'kodeMakanan' => $validatedData['food'][$i],
                'qty' => $validatedData['qty'][$i],
                'harga' => $validatedData['harga'][$i],
                'total' => $validatedData['total'][$i],
                // ... dan seterusnya sesuai dengan field yang ada pada model Item
            ]);
        }
        nomorRegisFrakturBeli::create([
            'kode' => $validatedData['nomorRegis'],
            'kodeSupplier' => $validatedData['supplier'],
            'total' => $validatedData['totalKeseluruhan'],
            'tanggal' => $validatedData['tanggal'],
            // ... dan seterusnya sesuai dengan field yang ada pada model Item
        ]);
        return redirect('/buyFractures')->with('success','Data diupdate');
    }

    public function print($request)
    {
        $nomorRegis=nomorRegisFrakturBeli::all()->find($request);
        $buyFractures = frakturBeli::query()->where('kodeTransaksi','like','%'.$nomorRegis->kode.'%')->get();
        $supplier = supplier::query()->where('kode','like','%'.$nomorRegis->kodeSupplier.'%')->get()->first();
        $foods=food::all();
        $pdf = Pdf::loadView('buyFractures.buyFracturePrintPdf', [
            "foods" => $foods,
            "supplier" => $supplier,
            "buyFractures" => $buyFractures,
            "nomorRegis" => $nomorRegis,
        ])->setPaper('f4', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('Buy Facture.pdf');
    }
    /**
     * Display the specified resource.
     */
    public function show($request)
    {
        $nomorRegis=nomorRegisFrakturBeli::all()->find($request);
        $buyFractures = frakturBeli::query()->where('kodeTransaksi','like','%'.$nomorRegis->kode.'%')->get();
        $supplier = supplier::query()->where('kode','like','%'.$nomorRegis->kodeSupplier.'%')->get()->first();
        $foods=food::all();
        return view('buyFractures/buyFracturePrint',[
            "title"=>"Detail Fraktur Beli",
            "foods" => $foods,
            "supplier" => $supplier,
            "buyFractures" => $buyFractures,
            "nomorRegis" => $nomorRegis,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(frakturBeli $frakturBeli)
    {
        $foods = food::all();
        $suppliers = supplier::all();
        return view('buyFractures/buyFractureIn',[
            "title"=>"Tambah Fraktur Beli",
            "foods" => $foods,
            "suppliers" => $suppliers,
            "frakturBeli" => $frakturBeli,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefrakturBeliRequest $request, frakturBeli $frakturBeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(frakturBeli $frakturBeli)
    {
        //
    }

    public function printdelete(Request $request)
    {
        $foods = food::all();
        $suppliers = supplier::all();
        if($request->delete){
            frakturBeli::destroy($request->delete);
            return redirect('/stuffout')->with('success','Data Dihapus');
        }elseif($request->generate){
            $cek=false;
            $lastId = frakturBeli::orderBy('id', 'desc')->first()->id; // Mendapatkan ID terakhir
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
                        $foundMaterial = frakturBeli::find($request->$inputName);
                        if ($foundMaterial) {
                            $data[] = $foundMaterial; // Menambahkan model yang cocok ke dalam array $data
                        }
                    }
                }
                $pdf = Pdf::loadView('stuffoutf.pdf', [
                    "foods" => $foods,
                    "suppliers" => $suppliers,
                    "barangkeluars" => $data
                ])->setPaper('f4', 'landscape');
                return $pdf->download('Laporan_Barang_Keluar.pdf');
            }else{
                $buyFractures = frakturBeli::query();
                if(request('search')){                                     
                    $querytambahan1=supplier::where('kode','like','%'.request('search').'%')
                                                ->orWhere('nama','like','%'.request('search').'%')->get();
                    $querytambahan2=food::where('kode','like','%'.request('search').'%')
                                                ->orWhere('nama','like','%'.request('search').'%')->get();
                                                
                    $buyFractures->where('kodeMakanan','like','%'.request('search').'%')
                                                ->orWhere('kodeSupplier','like','%'.request('search').'%')
                                                ->orWhere('qty','like','%'.request('search').'%')
                                                ->orWhere('harga','like','%'.request('search').'%')
                                                ->orWhere('total','like','%'.request('search').'%')
                                                ->orWhere('tanggal','like','%'.request('search').'%');
                    
                    foreach($querytambahan1 as $querytambahan){
                        $querybantuan= (string)$querytambahan->kode;
                        $buyFractures->orWhere('kodeSupplier','like','%'.$querybantuan.'%');
                    }

                    foreach($querytambahan2 as $querytambahan){
                        $querybantuan= (string)$querytambahan->kode;
                        $buyFractures->orWhere('kodeMakanan','like','%'.$querybantuan.'%');
                    }
                }
                $foods = $foods->toArray();
                $suppliers = $suppliers->toArray();
                $buyFractures = $buyFractures->get()->toArray();
                $pdf = Pdf::loadView('stuffoutf.pdf', [
                    "foods" => $foods,
                    "suppliers" => $suppliers,
                    "buyFractures" => $buyFractures
                ])->setPaper('f4', 'landscape');
                return $pdf->download('Laporan_Barang_Keluar.pdf');
            } 
        }
    }
}
