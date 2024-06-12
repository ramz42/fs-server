<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ...
        $nama = $request->nama;
        $files = Storage::disk('public')->allFiles("uploads/$nama/");
        return response()->json($files, 201);
    }

    public function images(Request $request)
    {
        // ...
        $nama = $request->nama;
        $files = Storage::disk('public')->allFiles("uploads/images/$nama/");
        return response()->json($files, 201);
    }

    public function images_edit(Request $request)
    {
        // ...
        $nama = $request->nama;
        $files = Storage::disk('public')->allFiles("uploads/images/edit/$nama/");
        return response()->json($files, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ...
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
        // ...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ...
    }
}
