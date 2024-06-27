<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Settings_menu;
use App\Models\Upload_photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

use Intervention\Image\ImageManagerStatic as Image;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // //
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // put image in the public storage
            $filePath = Storage::disk('public')->put('images/posts/featured-images', request()->file('featured_image'));
            $validated['featured_image'] = $filePath;

            return $filePath;
        }
    }


    public function imageUpload(Request $req)
    {
        $image = new Upload_photo;
        $image->nama = $req->nama;
        $image->type = $req->type;
        $image->title_photobooth = $req->title_photobooth;
        $fileName = $req->get('image') . '.jpg';

        if (!is_dir(storage_path("app/public/uploads/images/$image->nama/"))) {
            mkdir(storage_path("app/public/uploads/images/$image->nama/"), 0755, true);
        }

        $newPath = storage_path("app/public/uploads/images/$image->nama/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        if ($image->type == "Collage") {
            # code...
            $resize = Image::make($req->file('image'))->crop(1280, 720)->encode('jpg');
        } else {
            # code...
            $resize = Image::make($req->file('image'))->crop(1280, 720)->encode('jpg');
        }

        if ($req->hasFile('image')) {
            $filename = $req->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $req->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $image->nama . '_' . $image->title_photobooth . '.' . $getfileExtension; // create new random file name
            $image->image = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

            if ($image->save()) {
                // save file in databse
                return ['status' => true, 'message' => "Image uploded successfully", "image" => $newPhotoFullPath];
                return response()->json($req, 201);
                // ....
            } else {
                return ['status' => false, 'message' => "Error : Image not uploded successfully"];
            }
        }
    }

    public function retakePhoto(Request $req, String $id)
    {
        // code ...
        $image = new Upload_photo;
        $image->nama = $req->nama;
        $image->type = $req->type;
        $image->title_photobooth = $req->title_photobooth;
        $fileName = $req->get('image') . '.jpg';

        if (!is_dir(storage_path("app/public/uploads/images/$image->nama/"))) {
            mkdir(storage_path("app/public/uploads/images/$image->nama/"), 0755, true);
        }

        $newPath = storage_path("app/public/uploads/images/$image->nama/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        if ($image->type == "Collage") {
            # code...
            $resize = Image::make($req->file('image'))->crop(1280, 720)->encode('jpg');
        } else {
            # code...
            $resize = Image::make($req->file('image'))->crop(1280, 720)->encode('jpg');
        }

        if ($req->hasFile('image')) {
            $filename = $req->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $req->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $image->nama . '_' . $image->title_photobooth . '.' . $getfileExtension; // create new random file name
            $image->image = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

            if ($image->save()) {
                // save file in databse
                return ['status' => true, 'message' => "Image uploded successfully", "image" => $newPhotoFullPath];
                return response()->json($req, 201);
                // ....
            } else {
                return ['status' => false, 'message' => "Error : Image not uploded successfully"];
            }
        }
        // ...
    }


    // testing functions upload image to server
    public function uploadToServer(Request $req)
    {

        $image = new Upload_photo;
        $image->nama = $req->nama;
        // $image->nama = $req->file('image');
        // $req->nama = $req->nama;

        if (!is_dir(storage_path("app/public/uploads/images/$req->nama/"))) {
            mkdir(storage_path("app/public/uploads/images/$req->nama/"), 0755, true);
        }

        $newPath = storage_path("app/public/uploads/images/$req->nama/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        if ($req->hasFile('image')) {

            $filename = $req->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $req->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . "test" . '_' . "upload" . '.' . $getfileExtension; // create new random file name
            // $req->image = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://indophotobox.com/selfie/api/upload-image',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('nama' => 'rama-upload-test', 'title_photobooth' => 'photo booth collage b', 'image' => $newPhotoFullPath, 'type' => 'else'),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
            return ['status' => true, 'message' => $response];
        }
    }


    public function imageUploadPrint(Request $req)
    {
        // ...
        $image = new Upload_photo;
        $image->nama = $req->nama;
        $image->type = $req->type;
        $image->title_photobooth = $req->title_photobooth;
        $fileName = $req->get('image') . '.jpg';

        if (!is_dir(storage_path("app/public/uploads/print"))) {
            mkdir(storage_path("app/public/uploads/print"), 0755, true);
        }

        $newPath = storage_path('app/public/uploads/print/');
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        if ($image->type == "Collage A") {
            # code...
            $resize = Image::make($req->file('image'))->crop(677, 815)->encode('jpg'); // untuk ukuran 1920 x 1080 crop pada bagian foto tipe A => contoh, collage a 
        }
        if ($image->type == "Collage B") {
            # code...
            $resize = Image::make($req->file('image'))->crop(308, 749)->encode('jpg'); // untuk ukuran 1920 x 1080 crop pada bagian foto tipe B => contoh, collage b
        } else {
            # code...
            $resize = Image::make($req->file('image'))->crop(677, 815)->encode('jpg'); // untuk ukuran 1920 x 1080 crop pada bagian foto tipe A => contoh, collage a 
        }

        if ($req->hasFile('image')) {
            $filename = $req->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $req->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $image->nama . '_' . $image->title_photobooth . '.' . $getfileExtension; // create new random file name
            $image->image = $createnewFileName; // pass file name with column

            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        if ($image->save()) { // save file in databse
            return ['status' => true, 'message' => "Image uploded successfully", 'image' => $createnewFileName];

            return response()->json($req, 201);
        } else {
            return ['status' => false, 'message' => "Error : Image not uploded successfully"];
        }
    }

    public function settings(Request $req)
    {
        $settings = new Settings();

        
        $settings->judul = $req->judul;
        $settings->deskripsi = $req->deskripsi;
        $settings->pin = $req->pin;
        $settings->type = $req->type;
        $settings->server_key = $req->server_key;

        
        $fileName = $req->get('image') . '.jpg';

        if ($settings->type == "main") {
            # code...
            if (!is_dir(storage_path("app/public/background-image/main/"))) {
                mkdir(storage_path("app/public/background-image/main/"), 0755, true);
            }

            $newPath = storage_path('app/public/background-image/main/');
            if (!file_exists($newPath)) {
                mkdir($newPath, 0755);
            }
        } else {
            # code...
            if (!is_dir(storage_path("app/public/background-image/sub/"))) {
                mkdir(storage_path("app/public/background-image/sub"), 0755, true);
            }

            $newPath = storage_path('app/public/background-image/sub/');
            if (!file_exists($newPath)) {
                mkdir($newPath, 0755);
            }
        }

        // background image no resize
        $resize = Image::make($req->file('image'));


        if ($req->hasFile('image')) {

            $filename = $req->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $req->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $settings->type . '.' . $getfileExtension; // create new random file name

            $settings->image = $createnewFileName; // pass file name with column

            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        // update settings db
        DB::table('settings')
            ->where('type', $settings->type)
            ->update(['judul' => $settings->judul, 'deskripsi' => $settings->deskripsi, 'pin' => $settings->pin, 'type' => $settings->type, 'server_key' => $settings->server_key, 'image' => $settings->image,]);
        return response()->json($req, 201);
    }

    public function menu_settings(Request $req)
    {
        $settings = new Settings_menu();

        $settings->menu_title = $req->menu_title;
        $settings->title = $req->title;
        $settings->deskripsi = $req->deskripsi;
        $settings->harga = $req->harga;

        $fileName = $req->get('image') . '.jpg';

        if (!is_dir(storage_path("app/public/background-image/sub/"))) {
            mkdir(storage_path("app/public/background-image/sub/"), 0755, true);
        }

        $newPath = storage_path('app/public/background-image/sub/');
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        // background image no resize
        $resize = Image::make($req->file('image'));


        if ($req->hasFile('image')) {

            $filename = $req->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $req->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $settings->menu_title . '.' . $getfileExtension; // create new random file name

            $settings->image = $createnewFileName; // pass file name with column

            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        DB::table('menu_settings')
            ->where('menu_title', $settings->menu_title)
            ->update(['title' => $settings->title, 'deskripsi' => $settings->deskripsi, 'harga' => $settings->harga, 'image' => $settings->image, 'menu_title' => $settings->menu_title,]);
        return response()->json($req, 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(Upload_photo $upload_photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upload_photo $upload_photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload_photo $upload_photo)
    {
        //
    }
}
