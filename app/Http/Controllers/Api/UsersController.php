<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User_foto as User_fotos;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
        $user_foto->status_transaksi = $request->status_transaksi;

        $user = User_fotos::create($request->all());

        return response()->json($user_foto, 201);
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
    public function show(User_fotos $user)
    {
        //
        return response()->json($user);
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
    public function update(Request $request, $id)
    {
        //
        $nama = $request->nama;
        $title_photobooth = $request->title_photobooth;
        $harga = $request->harga;
        $id_foto = $request->id_foto;

        $user_foto = User_fotos::find($id);
        $user_foto->nama = $nama;
        $user_foto->title_photobooth = $title_photobooth;
        $user_foto->harga = $harga;
        $user_foto->id_foto = $id_foto;

        $user_foto->save();

        $user_foto->update($request->all());

        return response()->json($user_foto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $user = User_fotos::find($id);
        $user->delete();

        return response()->json($user);
    }
}
