<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use File;

use App\Models\Edit_photo as Edit_photo;

class EditPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Edit_photo::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $edit_photo = new Edit_photo();
        $edit_photo->status = $request->status;

        $user = Edit_photo::create($request->all());

        return response()->json($edit_photo, 201);
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
        $user_foto = Edit_photo::find($id);
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
