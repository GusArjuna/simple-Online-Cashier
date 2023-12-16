<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use App\Http\Requests\StoresupplierRequest;
use App\Http\Requests\UpdatesupplierRequest;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = supplier::query();
        if(request('search')){                                        
            $suppliers->where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')
                                        ->orWhere('noTelp','like','%'.request('search').'%')
                                        ->orWhere('alamat','like','%'.request('search').'%')
                                        ->orWhere('keterangan','like','%'.request('search').'%');
        }
        return view('suppliers/supplier',[
            "title"=>"Daftar Supplier",
            "suppliers" => $suppliers->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers/supplierin',["title"=>"Tambah Data Supplier"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresupplierRequest $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'noTelp' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);
        supplier::create($validatedData);
        return redirect('/suppliers')->with('success','Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(supplier $supplier)
    {
        return view('suppliers/supplierEdit',[
            "title"=>"Edit Data Supplier",
            "supplier" => $supplier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesupplierRequest $request, supplier $supplier)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'noTelp' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);
        supplier::where('id',$supplier->id)
                    ->update($validatedData);
        return redirect('/suppliers')->with('success','Data diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(supplier $supplier)
    {
        //
    }


    public function printdelete(Request $request)
    {
        if($request->delete){
            supplier::destroy($request->delete);
            return redirect('/suppliers')->with('success','Data Dihapus');
        }
    }
}
