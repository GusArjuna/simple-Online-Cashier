<?php

namespace App\Http\Controllers;

use App\Models\food;
use App\Http\Requests\StorefoodRequest;
use App\Http\Requests\UpdatefoodRequest;
use App\Models\foodCategory;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foodCategories = foodCategory::all();
        $foods = food::query();
        if(request('search')){ 
            $querytambahan1=foodCategory::where('kode','like','%'.request('search').'%')
                            ->orWhere('nama','like','%'.request('search').'%')->get();                                    
            $foods->where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')
                                        ->orWhere('kelompok','like','%'.request('search').'%')
                                        ->orWhere('qty','like','%'.request('search').'%')
                                        ->orWhere('hargaBeli','like','%'.request('search').'%')
                                        ->orWhere('hargaJual','like','%'.request('search').'%');
            foreach($querytambahan1 as $querytambahan){
                $querybantuan= (string)$querytambahan->kode;
                $foods->orWhere('kode','like','%'.$querybantuan.'%');
            }
        }
        return view('foods/food',[
            "title"=>"Daftar Makanan",
            "foods" => $foods->paginate(15),
            "foodCategories" => $foodCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $foodCategories = foodCategory::all();
        return view('foods/foodIn',[
            "title"=>"Tambah Makanan",
            "foodCategories" => $foodCategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefoodRequest $request)
    {
        dd($request);
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
            'qty' => 'required',
            'safetyStock' => 'required',
            'hargaJual' => 'required',
            'hargaBeli' => 'required',
            'kebutuhan' => 'required',
            'biayaPemesanan' => 'required',
            'waktu' => 'required',
            'keterangan' => 'required',
        ]);

        
        foodCategory::create($validatedData);
        return redirect('/foods')->with('success','Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefoodRequest $request, food $food)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(food $food)
    {
        //
    }
}
