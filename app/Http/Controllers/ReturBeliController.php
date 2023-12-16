<?php

namespace App\Http\Controllers;

use App\Models\returBeli;
use App\Http\Requests\StorereturBeliRequest;
use App\Http\Requests\UpdatereturBeliRequest;

class ReturBeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('buyReturns/buyReturn',["title"=>"Retur Beli"]);
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
