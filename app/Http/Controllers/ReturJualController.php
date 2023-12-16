<?php

namespace App\Http\Controllers;

use App\Models\returJual;
use App\Http\Requests\StorereturJualRequest;
use App\Http\Requests\UpdatereturJualRequest;

class ReturJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sellReturns/sellReturn',["title"=>"Retur Jual"]);
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
