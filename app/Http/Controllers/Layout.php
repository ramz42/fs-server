<?php

namespace App\Http\Controllers;

use App\Models\Layout as ModelsLayout;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Layout extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return ModelsLayout::all();
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
    public function show(Layout $layout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layout $layout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, String $nama)
    // {
    //     // ...
    //     $layout = new ModelsLayout();
    //     $layout->status = $request->status;

    //     DB::table('layout')
    //         ->where('nama', $nama)
    //         ->update(['status' => $request->status]);
    //     return response()->json($request, 201);
    // }
    public function update(Request $request, string $id)
    {
        // ...
        $id = $request->id;
        $layout =  ModelsLayout::find($id);
        $layout->nama = $request->nama;
        $layout->warna = $request->warna;
        $layout->status = $request->status;

        $fileName = $request->get('nama_img') . '.png';

        if (!is_dir(storage_path("app/public/background/"))) {
            mkdir(storage_path("app/public/background/"), 0755, true);
        }

        $newPath = storage_path("app/public/background/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        $resize = Image::make($request->file('nama_img'))->encode('jpg');

        if ($request->hasFile('nama_img')) {
            $filename = $request->file('nama_img')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $request->file('nama_img')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '-' . 'sticker' . '.' . $getfileExtension; // create new random file name
            // $background->nama_img = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

            if ($background->save()) {
                // update settings db

                $background->save();
                $background->update($request->all());

                return response()->json($background);
            } else {
                return ['status' => false, 'message' => "Error : Image not uploded successfully"];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layout $layout)
    {
        //
    }
}
