<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Models\MainColor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Edit_photo as Edit_photo;
use Intervention\Image\ImageManagerStatic as Image;
use File;


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
     * Display a listing of the resource.
     */
    public function index_background()
    {
        //
        return Background::all();
    }

    
    public function index_warna()
    {
        //
        return MainColor::all();
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

    
    public function storeMainColor(Request $request)
    {
        // ...
        $mainColor = new MainColor();

        $mainColor->bg_warna_wave = $request->bg_warna_wave;
        $mainColor->warna1 = $request->warna1;
        $mainColor->warna2 = $request->warna2;

        $warna = MainColor::whereId(1)->update($request->all());
        return response()->json($mainColor, 201);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeBg(Request $request)
    {
        // ...
        $background = new Background();
        $background->nama = $request->nama;
        $background->warna = $request->warna;
        $background->status = $request->status;

        $fileName = $request->get('image') . '.jpg';

        # code...
        if (!is_dir(storage_path("app/public/background-image/edit-photo/"))) {
            mkdir(storage_path("app/public/background-image/edit-photo/"), 0755, true);
        }

        $newPath = storage_path('app/public/background-image/edit-photo/');
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        // background image no resize
        $resize = Image::make($request->file('image'));

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $background->nama . '.' . $getfileExtension; // create new random file name
            $background->image = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        // update background db
        DB::table('background')
            ->insert(['nama' => $background->nama, 'image' => $background->image, 'warna' => $background->warna, 'status' => $background->status]);
        return response()->json($request, 201);
    }

    // update bg
    public function updateBg(Request $request, String $id)
    {
        // ...
        $background = Background::find($id);
        $background->nama = $request->nama;
        $background->warna = $request->warna;
        $background->status = $request->status;

        $fileName = $request->get('image') . '.jpg';

        # code...
        if (!is_dir(storage_path("app/public/background-image/edit-photo/"))) {
            mkdir(storage_path("app/public/background-image/edit-photo/"), 0755, true);
        }

        $newPath = storage_path('app/public/background-image/edit-photo/');
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        // background image no resize
        $resize = Image::make($request->file('image'));

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $background->nama . '.' . $getfileExtension; // create new random file name
            $background->image = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        // update background db
        
        $background->save();
        $background->update($request->all());

        return response()->json($background);
        // $bg = Background::whereId($param)->update($request->all());
        // return response()->json($bg, 201);
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
