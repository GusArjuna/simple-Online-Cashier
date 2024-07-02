<?php

namespace App\Http\Controllers;

use App\Models\foodCategory;
use App\Http\Requests\StorefoodCategoryRequest;
use App\Http\Requests\UpdatefoodCategoryRequest;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foodCategories = foodCategory::query();
        if(request('search')){                                        
            $foodCategories->where('kode','like','%'.request('search').'%')
                                        ->orWhere('nama','like','%'.request('search').'%')
                                        ->orWhere('keterangan','like','%'.request('search').'%');
        }
        return view('foodCategories/foodCategory',[
            "title"=>"Daftar Makanan",
            "foodCategories" => $foodCategories->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('foodCategories/foodCategoryIn',[
            "title" => "Tambah Kategori Makanan",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefoodCategoryRequest $request)
    {
        $validatedData = $request->validate([
            'kode' => ['required','unique:food_categories'],
            'nama' => 'required',
            'keterangan' => 'required',
        ]);
        foodCategory::create($validatedData);
        return redirect('/foodCategories')->with('success','Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(foodCategory $foodCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(foodCategory $foodCategory)
    {
        return view('foodCategories/foodCategoryEdit',[
            "title" => "Edit Food Category",
            "foodCategory" => $foodCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefoodCategoryRequest $request, foodCategory $foodCategory)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'keterangan' => 'required',
        ]);
        foodCategory::where('id',$foodCategory->id)
                    ->update($validatedData);
        return redirect('/foodCategories')->with('success','Data diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(foodCategory $foodCategory)
    {
        //
    }

    public function printdelete(Request $request)
    {
        if($request->delete){
            foodCategory::destroy($request->delete);
            return redirect('/foodCategories')->with('success','Data Dihapus');
        }
    }
}
