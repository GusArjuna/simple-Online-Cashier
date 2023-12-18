<?php

namespace App\Http\Controllers;

use App\Models\frakturJual;
use App\Http\Requests\StorefrakturJualRequest;
use App\Http\Requests\UpdatefrakturJualRequest;
use App\Models\food;
use App\Models\member;
use App\Models\nomorRegisFrakturJual;
use Barryvdh\DomPDF\Facade\Pdf;

class FrakturJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = member::all();
        $foods = food::all();
        $sellFracturenumbers = nomorRegisFrakturJual::query();
        if(request('search')){                                     
            $querytambahan1=member::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
            $querytambahan2=food::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
                                        
            $sellFracturenumbers->where('kodeMakanan','like','%'.request('search').'%')
                                ->orWhere('kodeMember','like','%'.request('search').'%')
                                ->orWhere('qty','like','%'.request('search').'%')
                                ->orWhere('harga','like','%'.request('search').'%')
                                ->orWhere('total','like','%'.request('search').'%')
                                ->orWhere('tanggal','like','%'.request('search').'%');
            
            foreach($querytambahan1 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $sellFracturenumbers->orWhere('kode','like','%'.$querybantuan.'%');
            }

            foreach($querytambahan2 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $sellFracturenumbers->orWhere('kode','like','%'.$querybantuan.'%');
            }
        }
        return view('sellFractures/sellFracture',[
            "title"=>"Fraktur Jual",
            "sellFracturenumbers" => $sellFracturenumbers->paginate(15),
            "foods" => $foods,
            "members" => $members,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nomorRegis = nomorRegisFrakturJual::latest()->first()->id??false;
        if($nomorRegis){
            $nomorRegis = 'BFR'.($nomorRegis+1);
        }else{
            $nomorRegis = 'BFR1';
        }
        $foods = food::all();
        $members = member::all();
        return view('sellFractures/sellFractureIn',[
            "title"=>"Tambah Fraktur Jual",
            "foods" => $foods,
            "members" => $members,
            "nomorRegis" => $nomorRegis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefrakturJualRequest $request)
    {
        for ($i=0; $i < count($request->qty); $i++) {
            $cek = food::query()->where('kode','like','%'.$request->food[$i].'%')->get()->first();
            if ($cek->qty<$request->qty[$i]) {
                return redirect('/sellFractures/datain')->with('error','Quantity melebihi stock');
            }
        }
        
        $validatedData = $request->validate([
            'nomorRegis' => 'required',
            'member' => 'required',
            'food.*' => 'required',
            'qty.*' => 'required',
            'totalKeseluruhan' => 'required',
            'tanggal' => 'required',
            'harga.*' => 'required',
            'total.*' => 'required',
        ]);          
       for ($i=0; $i < count($request->qty); $i++) { 
           
            $food = food::query()->where('kode','like','%'.$validatedData['food'][$i].'%')->get()->first();
            $newQty = $food->qty - intval($validatedData['qty'][$i]);
            $penjualan = $food->penjualan+intval($validatedData['qty'][$i]);
            food::where('id',$food->id)
                    ->update([
                        'qty'=> $newQty,
                        'penjualan' => $penjualan,
                    ]);
           
            frakturJual::create([
                'kodeTransaksi' => $validatedData['nomorRegis'],
                'kodeMakanan' => $validatedData['food'][$i],
                'qty' => $validatedData['qty'][$i],
                'harga' => $validatedData['harga'][$i],
                'total' => $validatedData['total'][$i],
                'tanggal' => $validatedData['tanggal'],
                // ... dan seterusnya sesuai dengan field yang ada pada model Item
            ]);
        }
        nomorRegisFrakturJual::create([
            'kode' => $validatedData['nomorRegis'],
            'kodeMember' => $validatedData['member'],
            'total' => $validatedData['totalKeseluruhan'],
            'tanggal' => $validatedData['tanggal'],
            // ... dan seterusnya sesuai dengan field yang ada pada model Item
        ]);
        return redirect('/sellFractures')->with('success','Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function print($request)
    {
        $nomorRegis=nomorRegisFrakturJual::all()->find($request);
        $sellFractures = frakturJual::query()->where('kodeTransaksi','like','%'.$nomorRegis->kode.'%')->get();
        $member = member::query()->where('kode','like','%'.$nomorRegis->kodeMember.'%')->get()->first();
        $foods=food::all();
        $pdf = Pdf::loadView('sellFractures.sellFracturePrintPdf', [
            "foods" => $foods,
            "member" => $member,
            "sellFractures" => $sellFractures,
            "nomorRegis" => $nomorRegis,
        ])->setPaper('f4', 'landscape')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('Sell Facture.pdf');
    }

    public function show($request)
    {
        $nomorRegis=nomorRegisFrakturJual::all()->find($request);
        $sellFractures = frakturJual::query()->where('kodeTransaksi','like','%'.$nomorRegis->kode.'%')->get();
        $member = member::query()->where('kode','like','%'.$nomorRegis->kodeMember.'%')->get()->first();
        $foods=food::all();
        return view('sellFractures/sellFracturePrint',[
            "title"=>"Detail Fraktur Beli",
            "foods" => $foods,
            "member" => $member,
            "sellFractures" => $sellFractures,
            "nomorRegis" => $nomorRegis,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(frakturJual $frakturJual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefrakturJualRequest $request, frakturJual $frakturJual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(frakturJual $frakturJual)
    {
        //
    }
}
