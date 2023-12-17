<?php

namespace App\Http\Controllers;

use App\Models\eoqtable;
use App\Http\Requests\StoreeoqtableRequest;
use App\Http\Requests\UpdateeoqtableRequest;
use App\Models\food;

class EoqtableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreeoqtableRequest $request)
    {
        //
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
