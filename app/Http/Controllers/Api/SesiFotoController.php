<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Sesi_foto as Sesi_photo;

class SesiFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // menampilkan semua data user
        return Sesi_photo::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $sesi_photo = new Sesi_photo();
        $sesi_photo->status = $request->status;
        $sesi_photo->nama = $request->nama;
        $sesi_photo->title = $request->title;

        $user = Sesi_photo::create($request->all());

        return response()->json($sesi_photo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user_foto = Sesi_photo::find($id);
        $user_foto->status = $request->status;
        $user_foto->nama = $request->nama;
        $user_foto->title = $request->title;

        $user_foto->save();
        $user_foto->update($request->all());

        return response()->json($user_foto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
