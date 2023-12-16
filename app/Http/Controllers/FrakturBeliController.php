<?php

namespace App\Http\Controllers;

use App\Models\frakturBeli;
use App\Http\Requests\StorefrakturBeliRequest;
use App\Http\Requests\UpdatefrakturBeliRequest;
use App\Models\food;
use App\Models\member;

class FrakturBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = member::all();
        $foods = food::all();
        $buyFractures = frakturBeli::query();
        if(request('search')){                                     
            $querytambahan1=member::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
            $querytambahan2=food::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
                                        
            $buyFractures->where('kodeMaterial','like','%'.request('search').'%')
                                        ->orWhere('jumlah','like','%'.request('search').'%')
                                        ->orWhere('kondisi','like','%'.request('search').'%')
                                        ->orWhere('keterangan','like','%'.request('search').'%')
                                        ->orWhere('keperluan','like','%'.request('search').'%')
                                        ->orWhere('keterangan','like','%'.request('search').'%')
                                        ->orWhere('peminjam','like','%'.request('search').'%')
                                        ->orWhere('divisi','like','%'.request('search').'%')
                                        ->orWhere('tanggalKeluar','like','%'.request('search').'%');
            
            foreach($querytambahan1 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $buyFractures->orWhere('kode','like','%'.$querybantuan.'%');
            }

            foreach($querytambahan2 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $buyFractures->orWhere('kode','like','%'.$querybantuan.'%');
            }
        }
        return view('buyFractures/buyFracture',[
            "title"=>"Fraktur Beli",
            "buyFractures" => $buyFractures->paginate(15),
            "foods" => $foods,
            "members" => $members,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buyFractures/buyFractureIn',["title"=>"Tambah Fraktur Beli"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefrakturBeliRequest $request)
    {
        //
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
        //
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
}
