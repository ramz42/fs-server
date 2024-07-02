<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;


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


    public function deleteFolderImagesEdit(Request $request)
    {
        // request filename
        $folder_name = $request->folder_name;

        if(Storage::deleteDirectory("public/uploads/images/edit/$folder_name")) {
            return "delete directory $folder_name berhasil";
        }
    }

    // delete folder images edit

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
    public function show(String $id)
    {
        //
        return "hei $id";
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
    public function delete(Request $req)
    {
        // request filename
        $filename = $req->filename;

        // delete image
        unlink(storage_path("app/public/" . $filename));
        return "delete image $filename , berhasil";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteFolder(Request $request)
    {
        // request filename
        $folder_name = $request->folder_name;

        if(Storage::deleteDirectory("public/$folder_name")) {
            return "delete directory $folder_name berhasil";
        }
    }
}
