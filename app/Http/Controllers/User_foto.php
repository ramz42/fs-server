<?php

namespace App\Http\Controllers;

use App\Models\User_foto as User_fotos;
use Illuminate\Http\Request;

class User_foto extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan semua data user
        return User_fotos::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        //
        $user_foto = new User_fotos();
        $user_foto->nama = $request->nama;
        $user_foto->title_photobooth = $request->title_photobooth;
        $user_foto->harga = $request->harga;
        $user_foto->id_foto = $request->id_foto;

        return "Data berhasil masuk";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $id_foto = $request->id_foto;
        
        $user =  User_fotos::find($id);
        $user->id_foto = $id_foto;
        $user->save();

        return "Data Berhasil di update";
        // $user_foto->nama = $request->nama;
        // $user_foto->title_photobooth = $request->title_photobooth;
        // $user_foto->harga = $request->harga;
        // $user_foto->id_foto = $request->id_foto;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User_fotos::find($id);
        $user->delete();

        return "Data Berhasil Di Hapus";
    }
}
