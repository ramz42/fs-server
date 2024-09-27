<?php

namespace App\Http\Controllers;

use App\Models\Background as ModelsBackground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class Background extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // ...
        $background = new ModelsBackground();
        $background->nama = $request->nama;
        $background->warna = $request->warna;
        $background->status = $request->status;

        if (!is_dir(storage_path("app/public/background/"))) {
            mkdir(storage_path("app/public/background/"), 0755, true);
        }

        $newPath = storage_path("app/public/background/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        $resize = Image::make($request->file('nama_img'))->encode('jpg');

        if ($request->hasFile('nama_img')) {
            $getfileExtension = $request->file('nama_img')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $background->nama . '.' . $getfileExtension; // create new random file name
            $background->nama_img = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

            // insert sticker
            DB::table('background')->insert(['nama' => $background->nama,  'nama_img' => $background->nama_img, 'status' => $background->status]);
            // save file in databse
            return ['status' => true, 'message' => "Sticker uploded successfully"];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sticker $sticker)
    {
        // get all stickers
        return ModelsBackground::all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sticker $sticker, string $id)
    {
        // ...
        $id = $request->id;
        $background =  ModelsBackground::find($id);;
        $background->nama = $request->nama;
        $background->warna = $request->warna;
        $background->status = $request->status;

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
    public function destroy(string $id)
    {
        //
    }
}
