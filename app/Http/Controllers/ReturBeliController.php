<?php

namespace App\Http\Controllers;

use App\Models\returBeli;
use App\Http\Requests\StorereturBeliRequest;
use App\Http\Requests\UpdatereturBeliRequest;
use App\Models\food;
use App\Models\supplier;

class ReturBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = supplier::all();
        $foods = food::all();
        $buyReturns = returBeli::query();
        if(request('search')){                                     
            $querytambahan1=supplier::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
            $querytambahan2=food::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
                                        
            $buyReturns->where('kodeMakanan','like','%'.request('search').'%')
                                ->orWhere('kodeMember','like','%'.request('search').'%')
                                ->orWhere('qty','like','%'.request('search').'%')
                                ->orWhere('harga','like','%'.request('search').'%')
                                ->orWhere('total','like','%'.request('search').'%')
                                ->orWhere('alasan','like','%'.request('search').'%')
                                ->orWhere('tanggal','like','%'.request('search').'%');
            
            foreach($querytambahan1 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $buyReturns->orWhere('kode','like','%'.$querybantuan.'%');
            }

            foreach($querytambahan2 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $buyReturns->orWhere('kode','like','%'.$querybantuan.'%');
            }
        }
        return view('buyReturns/buyReturn',[
            "title"=>"Retur Beli",
            "buyReturns" => $buyReturns->paginate(15),
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
        return view('buyReturns/buyReturnIn',[
            "title"=>"Tambah Retur Beli",
            "foods" => $foods,
            "suppliers" => $suppliers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorereturBeliRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(returBeli $returBeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(returBeli $returBeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatereturBeliRequest $request, returBeli $returBeli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(returBeli $returBeli)
    {
        //
    }
}
