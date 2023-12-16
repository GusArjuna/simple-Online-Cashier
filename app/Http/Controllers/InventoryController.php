<?php

namespace App\Http\Controllers;

use App\Models\inventory;
use App\Http\Requests\StoreinventoryRequest;
use App\Http\Requests\UpdateinventoryRequest;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = inventory::query();
        if(request('search')){                                     
            $inventories->where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')
                                        ->orWhere('alamat','like','%'.request('search').'%')
                                        ->orWhere('keterangan','like','%'.request('search').'%');
        }
        return view('inventory/inventory',[
            "title"=>"Gudang",
            "inventories" => $inventories->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory/inventoryIn',["title"=>"Tambah Data Gudang"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreinventoryRequest $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);
        
        
        inventory::create($validatedData);
        return redirect('/inventories')->with('success','Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventory $inventory)
    {
        return view('inventory/inventoryEdit',[
            "title"=>"Edit Data Gudang",
            "inventory" => $inventory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinventoryRequest $request, inventory $inventory)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);
        
        inventory::where('id',$inventory->id)
                    ->update($validatedData);
        return redirect('/inventories')->with('success','Data diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inventory $inventory)
    {
        //
    }

    public function printdelete(Request $request)
    {
        if($request->delete){
            inventory::destroy($request->delete);
            return redirect('/inventories')->with('success','Data Dihapus');
        }
    }
}
