<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Settings;
use App\Models\Settings_menu;
use App\Models\StickerModel;
use App\Models\Stickers;
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
        $fileName = $req->get('image') . '.png';

        if (!is_dir(storage_path("app/public/uploads/images/$image->nama/"))) {
            mkdir(storage_path("app/public/uploads/images/$image->nama/"), 0755, true);
        }

        $newPath = storage_path("app/public/uploads/images/$image->nama/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        if ($image->type == "Collage") {
            # code...
            $resize = Image::make($req->file('image'))->encode('png');
        } else {
            # code...
            $resize = Image::make($req->file('image'))->encode('png');
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
                // return response()->json($req, 201);
                // ....
            } else {
                return ['status' => false, 'message' => "Error : Image not uploded successfully"];
            }
        }
    }

    // order settings
    public function order(Request $req)
    {
        $order = new Order;
        $order->title = $req->title;
        $fileName = $req->get('header_image') . '.png';
        $fileName2 = $req->get('background_image') . '.png';

        if (!is_dir(storage_path("app/public/order/header-image/"))) {
            mkdir(storage_path("app/public/order/header-image/"), 0755, true);
        }

        $newPath = storage_path("app/public/order/header-image/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        if (!is_dir(storage_path("app/public/order/background-image/"))) {
            mkdir(storage_path("app/public/order/background-image/"), 0755, true);
        }

        $newPath2 = storage_path("app/public/order/background-image/");
        if (!file_exists($newPath2)) {
            mkdir($newPath2, 0755);
        }

        $resize = Image::make($req->file('header_image'))->encode('png');
        $resize2 = Image::make($req->file('background_image'))->encode('png');

        if ($req->hasFile('header_image') && $req->hasFile('background_image')) {
            $filename = $req->file('header_image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $req->file('header_image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '-' . 'header' . '.' . $getfileExtension; // create new random file name
            $order->header_image = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

            $filename2 = $req->file('background_image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename2, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension2 = $req->file('background_image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName2 = time() . '-' . 'background' . '.' . $getfileExtension2; // create new random file name
            $order->background_image = $createnewFileName2; // pass file name with column
            $newPhotoFullPath2 = $newPath2 . $createnewFileName2;
            $resize2->save($newPhotoFullPath2);

            if ($order->save()) {

                // update settings db
                DB::table('halaman_order')
                    ->where('title', $order->title)
                    ->update(['title' => $order->title, 'header_image' => $order->header_image, 'background_image' => $order->background_image]);
                // save file in databse
                return ['status' => true, 'message' => "Image uploded successfully", "image" => $newPhotoFullPath, "image2" => $newPhotoFullPath2];
                // return response()->json($req, 201);
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
        $fileName = $req->get('image') . '.png';

        if (!is_dir(storage_path("app/public/uploads/images/$image->nama/"))) {
            mkdir(storage_path("app/public/uploads/images/$image->nama/"), 0755, true);
        }

        $newPath = storage_path("app/public/uploads/images/$image->nama/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        if ($image->type == "Collage") {
            # code...
            $resize = Image::make($req->file('image'))->crop(1280, 720)->encode('png');
        } else {
            # code...
            $resize = Image::make($req->file('image'))->crop(1280, 720)->encode('png');
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


    // testing functions upload image to server
    public function uploadToServer(Request $req)
    {

        $image = new Upload_photo;
        $image->nama = $req->nama;

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
        $fileName = $req->get('image') . '.png';

        if (!is_dir(storage_path("app/public/uploads/print"))) {
            mkdir(storage_path("app/public/uploads/print"), 0755, true);
        }

        $newPath = storage_path('app/public/uploads/print/');
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        // str_contains('consent', 'sent') // true, string contains, // di image intervention ada rotate
        if (str_contains($image->title_photobooth, "4x6")) {
            # code...
            $resize = Image::make($req->file('image'))->crop(600, 860)->resize(1200, 1800)->encode('png'); // untuk ukuran 1920 x 1080 crop pada bagian foto tipe A => contoh, collage a 
        } else {
            # code...
            // 3x4 tipe
            $resize = Image::make($req->file('image'))->crop(600, 860)->resize(1200, 1800)->encode('png');
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
        } else {
            return ['status' => false, 'message' => "Error : Image not uploded successfully"];
        }
    }

    public function editImage(Request $req)
    {
        // ...
        $nama = $req->nama;
        $nama_image = $req->nama_image;

        // variable skala dan rotasi image
        $rotate_value = $req->rotate_value; // (- minus degree to right), (+ degree to left)
        $resize_value1 = $req->resize_value1;
        $resize_value2 = $req->resize_value2;

        $fileName = $req->get('image') . '.png';

        if (!is_dir(storage_path("app/public/uploads/images/edit/$nama/"))) {
            mkdir(storage_path("app/public/uploads/images/edit/$nama/"), 0755, true);
        }

        $newPath = storage_path("app/public/uploads/images/edit/$nama/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        $resize = Image::make($req->file('image'))->rotate($rotate_value)->resize($resize_value1, $resize_value2)->encode('png');

        if ($req->hasFile('image')) {
            $filename = $req->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $req->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName =  $nama_image; // create new random file name
            $image = $createnewFileName; // pass file name with column

            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
            return ['status' => true, 'message' => "Image uploded successfully", 'image' => $newPhotoFullPath];
        }

        // if ($resize->save($newPhotoFullPath)) { // save file in databse
        //     return ['status' => true, 'message' => "Image uploded successfully", 'image' => $createnewFileName];
        // } else {
        //     return ['status' => false, 'message' => "Error : Image not uploded successfully"];
        // }
    }

    public function settings(Request $req)
    {
        $settings = new Settings();

        $settings->judul = $req->judul;
        $settings->deskripsi = $req->deskripsi;
        $settings->pin = $req->pin;
        $settings->type = $req->type;
        $settings->server_key = $req->server_key;
        $settings->string_logo = $req->string_logo;

        $fileName = $req->get('image') . '.png';

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
            ->update(['judul' => $settings->judul, 'deskripsi' => $settings->deskripsi, 'pin' => $settings->pin, 'type' => $settings->type, 'server_key' => $settings->server_key, 'image' => $settings->image, 'string_logo' => $settings->string_logo]);
        return response()->json($req, 201);
    }

    public function menu_settings(Request $req)
    {
        $settings = new Settings_menu();

        $settings->menu_title = $req->menu_title;
        $settings->title = $req->title;
        $settings->deskripsi = $req->deskripsi;
        $settings->harga = $req->harga;

        $fileName = $req->get('image') . '.png';

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
