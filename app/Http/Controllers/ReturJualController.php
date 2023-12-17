<?php

namespace App\Http\Controllers;

use App\Models\returJual;
use App\Http\Requests\StorereturJualRequest;
use App\Http\Requests\UpdatereturJualRequest;
use App\Models\food;
use App\Models\member;

class ReturJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = member::all();
        $foods = food::all();
        $sellReturns = returJual::query();
        if(request('search')){                                     
            $querytambahan1=member::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
            $querytambahan2=food::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
                                        
            $sellReturns->where('kodeMakanan','like','%'.request('search').'%')
                                ->orWhere('kodeMember','like','%'.request('search').'%')
                                ->orWhere('qty','like','%'.request('search').'%')
                                ->orWhere('harga','like','%'.request('search').'%')
                                ->orWhere('total','like','%'.request('search').'%')
                                ->orWhere('alasan','like','%'.request('search').'%')
                                ->orWhere('tanggal','like','%'.request('search').'%');
            
            foreach($querytambahan1 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $sellReturns->orWhere('kode','like','%'.$querybantuan.'%');
            }

            foreach($querytambahan2 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $sellReturns->orWhere('kode','like','%'.$querybantuan.'%');
            }
        }
        return view('sellReturns/sellReturn',[
            "title"=>"Retur Jual",
            "sellReturns" => $sellReturns->paginate(15),
            "foods" => $foods,
            "members" => $members,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $foods = food::all();
        $members = member::all();
        return view('sellReturns/sellReturnIn',[
            "title"=>"Tambah Retur Jual",
            "foods" => $foods,
            "members" => $members,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorereturJualRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(returJual $returJual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(returJual $returJual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatereturJualRequest $request, returJual $returJual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(returJual $returJual)
    {
        //
    }
}
