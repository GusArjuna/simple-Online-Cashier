<?php

namespace App\Http\Controllers;

use App\Models\frakturJual;
use App\Http\Requests\StorefrakturJualRequest;
use App\Http\Requests\UpdatefrakturJualRequest;

class FrakturJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sellFractures/sellFracture',["title"=>"Fraktur Jual"]);
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
