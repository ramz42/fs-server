<?php

namespace App\Http\Controllers;

use App\Models\Sticker_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class Sticker extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ...
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ...
        $sticker = new Sticker_model();
        $sticker->nama = $request->nama;
        $sticker->status = $request->status;
        // $sticker->nama_img = $request->nama_img;

        if (!is_dir(storage_path("app/public/sticker/"))) {
            mkdir(storage_path("app/public/sticker/"), 0755, true);
        }

        $newPath = storage_path("app/public/sticker/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        $resize = Image::make($request->file('nama_img'))->encode('jpg');

        if ($request->hasFile('nama_img')) {
            $getfileExtension = $request->file('nama_img')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $sticker->nama . '.' . $getfileExtension; // create new random file name
            $sticker->nama_img = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

              // insert sticker
              DB::table('sticker')->insert(['nama' => $sticker->nama,  'nama_img' => $sticker->nama_img, 'status' => $sticker->status]);
              // save file in databse
              return ['status' => true, 'message' => "Sticker uploded successfully"];
        }

        // if ($sticker->save()) {
        //     // insert sticker
        //     DB::table('sticker')->insert(['nama' => $sticker->nama,  'nama_img' => $request->file('nama_img'), 'status' => $sticker->status]);
        //     // save file in databse
        //     return ['status' => true, 'message' => "Sticker uploded successfully"];
        // } else {
        //     return ['status' => false, 'message' => "Error : Image not uploded successfully"];
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sticker $sticker)
    {
        // get all stickers
        return Sticker_Model::all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sticker $sticker, string $id)
    {
        // ...
        $id = $request->id;
        $sticker =  Sticker_Model::find($id);;
        $sticker->nama = $request->nama;
        $sticker->status = $request->status;

        $fileName = $request->get('nama_img') . '.png';

        if (!is_dir(storage_path("app/public/sticker/"))) {
            mkdir(storage_path("app/public/sticker/"), 0755, true);
        }

        $newPath = storage_path("app/public/sticker/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        $resize = Image::make($request->file('nama_img'))->encode('jpg');

        if ($request->hasFile('nama_img')) {
            $filename = $request->file('nama_img')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $request->file('nama_img')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '-' . 'sticker' . '.' . $getfileExtension; // create new random file name
            $sticker->nama_img = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

            if ($sticker->save()) {
                // update settings db
                DB::table('sticker')->insert(['nama' => $sticker->nama, 'status' => $sticker->status, 'nama_img' => $sticker->nama_img]);
                // save file in databse
                return ['status' => true, 'message' => "Sticker uploded successfully"];
            } else {
                return ['status' => false, 'message' => "Error : Image not uploded successfully"];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sticker $sticker)
    {
        //
    }
}
