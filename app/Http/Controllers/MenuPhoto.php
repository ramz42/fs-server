<?php

namespace App\Http\Controllers;

use App\Models\Settings_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Intervention\Image\ImageManagerStatic as Image;

class MenuPhoto extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan semua data user
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ...
        $settings = new Settings_menu();
        $settings->menu_title = $request->menu_title;
        $settings->title = $request->title;
        $settings->deskripsi = $request->deskripsi;
        $settings->harga = $request->harga;
        $settings->waktu = $request->waktu;

        $fileName = $request->get('image') . '.jpg';

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
            // image hasfile
            $filename = $request->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $settings->menu_title . '.' . $getfileExtension; // create new random file name

            $settings->image = $createnewFileName; // pass file name with column

            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        DB::table('menu_settings')->insertOrIgnore([
            ['title' => $settings->title, 'deskripsi' => $settings->deskripsi, 'harga' => $settings->harga, 'image' => $settings->image, 'menu_title' => $settings->menu_title, 'waktu' => $settings->waktu],
        ]);

        return response()->json($request, 201);
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
        // ...
        $settings = new Settings_menu();
        $settings->menu_title = $request->menu_title;
        $settings->title = $request->title;
        $settings->deskripsi = $request->deskripsi;
        $settings->harga = $request->harga;
        $settings->waktu = $request->waktu;

        $fileName = $request->get('image') . '.jpg';

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
            $createnewFileName = time() . '_' . $settings->menu_title . '.' . $getfileExtension; // create new random file name

            $settings->image = $createnewFileName; // pass file name with column

            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        DB::table('menu_settings')
            ->where('menu_title', $settings->menu_title)
            ->update(['title' => $settings->title, 'deskripsi' => $settings->deskripsi, 'harga' => $settings->harga, 'image' => $settings->image, 'menu_title' => $settings->menu_title, 'waktu' => $settings->waktu]);
        return response()->json($request, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ...
        $res = Settings_menu::where('menu_title', $id)->delete();
        return "Data ke $id Berhasil Di Hapus";
    }
}
