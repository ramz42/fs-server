<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class HalamanSettings extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return "Halaman Settings";
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
    public function update(Request $request)
    {
        //
        $settings = new Settings();
        
        $settings->judul = $request->judul;
        $settings->deskripsi = $request->deskripsi;
        $settings->pin = $request->pin;
        $settings->type = $request->type;
        $settings->server_key = $request->server_key;
        // $settings->background_image = $request->background_image;

        // $settings->save();

        // 'judul', 'deskripsi', 'pin', 'type', 'server_key', 'background_image'

        // return "Data Halaman Settings Berhasil di update";

        if (!is_dir(storage_path("app/public/background-image/sub/"))) {
            mkdir(storage_path("app/public/background-image/sub/"), 0755, true);
        }

        $newPath = storage_path('app/public/background-image/sub/');
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        // background image no resize
        $resize = Image::make($request->file('image'));

        if ($request->hasFile('image')) {

            $filename = $request->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $settings->type . '.' . $getfileExtension; // create new random file name

            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        DB::table('settings')
            ->where('type', "main")
            ->update(['judul' => $settings->judul, 'deskripsi' => $settings->deskripsi, 'pin' => $settings->pin, 'type' => $settings->type, 'server_key' => $settings->server_key, 'background_image' => $createnewFileName]);
        return response()->json($request, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
