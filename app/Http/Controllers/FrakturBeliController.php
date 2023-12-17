<?php

namespace App\Http\Controllers;

use App\Models\frakturBeli;
use App\Http\Requests\StorefrakturBeliRequest;
use App\Http\Requests\UpdatefrakturBeliRequest;
use App\Models\food;
use App\Models\member;
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
        $foods = food::all();
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
        return view('buyFractures/buyFracture',[
            "title"=>"Fraktur Beli",
            "buyFractures" => $buyFractures->paginate(15),
            "foods" => $foods,
            "suppliers" => $suppliers,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $foods = food::all();
        $suppliers = supplier::all();
        return view('buyFractures/buyFractureIn',[
            "title"=>"Tambah Fraktur Beli",
            "foods" => $foods,
            "suppliers" => $suppliers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefrakturBeliRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(frakturBeli $frakturBeli)
    {
        //
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
