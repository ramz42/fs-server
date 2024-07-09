<?php

namespace App\Http\Controllers;

use App\Models\serial_key;
use App\Http\Requests\Storeserial_keyRequest;
use App\Http\Requests\Updateserial_keyRequest;
use App\Models\Serial_key as ModelsSerial_key;

class SerialKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan semua data user
        return ModelsSerial_key::all();
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
    public function store(Storeserial_keyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(serial_key $serial_key)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(serial_key $serial_key)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateserial_keyRequest $request, serial_key $serial_key)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(serial_key $serial_key)
    {
        //
    }
}
