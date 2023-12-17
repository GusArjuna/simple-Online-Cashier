<?php

namespace App\Http\Controllers;

use App\Models\frakturJual;
use App\Http\Requests\StorefrakturJualRequest;
use App\Http\Requests\UpdatefrakturJualRequest;
use App\Models\food;
use App\Models\member;

class FrakturJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = member::all();
        $foods = food::all();
        $sellFractures = frakturJual::query();
        if(request('search')){                                     
            $querytambahan1=member::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
            $querytambahan2=food::where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')->get();
                                        
            $sellFractures->where('kodeMakanan','like','%'.request('search').'%')
                                ->orWhere('kodeMember','like','%'.request('search').'%')
                                ->orWhere('qty','like','%'.request('search').'%')
                                ->orWhere('harga','like','%'.request('search').'%')
                                ->orWhere('total','like','%'.request('search').'%')
                                ->orWhere('tanggal','like','%'.request('search').'%');
            
            foreach($querytambahan1 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $sellFractures->orWhere('kode','like','%'.$querybantuan.'%');
            }

            foreach($querytambahan2 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $sellFractures->orWhere('kode','like','%'.$querybantuan.'%');
            }
        }
        return view('sellFractures/sellFracture',[
            "title"=>"Fraktur Jual",
            "sellFractures" => $sellFractures->paginate(15),
            "foods" => $foods,
            "members" => $members,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefrakturJualRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(frakturJual $frakturJual)
    {
        //
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
