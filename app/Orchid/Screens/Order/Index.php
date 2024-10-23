<?php

namespace App\Orchid\Screens\Order;

use App\Models\Settings_menu;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;

class Index extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Index';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [];
    }
}

// // Halaman Order
// class HalamanOrder extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(): iterable
//     {
//         return [];
//     }

//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Background Image';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Order")->icon('plus')->route('platform.order-buat'),
//             Link::make("Update Order")->icon('pencil')->route('platform.order-update'),
//             Link::make("Delete Order")->icon('trash')->route('platform.order-delete'),

//             Link::make("Tema Warna")->icon('circle')->route('platform.warna-halaman'),
//             Link::make("Background Image")->icon('image')->route('platform.halaman-order'),
//         ];
//     }

//     /**
//      * The screen's layout elements.
//      *
//      * @return \Orchid\Screen\Layout[]|string[]
//      */
//     public function layout(): iterable
//     {
//         return [
//             Layout::rows([

//                 Input::make('header_image')->type('file')
//                     ->title('Header Image'),
//                 Input::make('background_image')->type('file')
//                     ->title('Background Image'),

//                 Button::make('Simpan')
//                     ->method('order'),
//             ]),
//         ];
//     }

//     // ...
//     public function order(Request $req)
//     {

//         if (!is_dir(storage_path("app/public/order/header-image/"))) {
//             mkdir(storage_path("app/public/order/header-image/"), 0755, true);
//         }

//         $newPath = storage_path("app/public/order/header-image/");
//         if (!file_exists($newPath)) {
//             mkdir($newPath, 0755);
//         }

//         if (!is_dir(storage_path("app/public/order/background-image/"))) {
//             mkdir(storage_path("app/public/order/background-image/"), 0755, true);
//         }

//         $newPath2 = storage_path("app/public/order/background-image/");
//         if (!file_exists($newPath2)) {
//             mkdir($newPath2, 0755);
//         }

//         $resize = Image::make($req->file('header_image'))->encode('png');
//         $resize2 = Image::make($req->file('background_image'))->encode('png');

//         if ($req->hasFile('header_image') && $req->hasFile('background_image')) {
//             $getfileExtension = $req->file('header_image')->getClientOriginalExtension(); // get the file extension
//             $createnewFileName = time() . '-' . 'header' . '.' . $getfileExtension; // create new random file name
//             $newPhotoFullPath = $newPath . $createnewFileName;
//             $resize->save($newPhotoFullPath);

//             $getfileExtension2 = $req->file('background_image')->getClientOriginalExtension(); // get the file extension
//             $createnewFileName2 = time() . '-' . 'background' . '.' . $getfileExtension2; // create new random file name
//             $newPhotoFullPath2 = $newPath2 . $createnewFileName2;
//             $resize2->save($newPhotoFullPath2);


//             // update settings db
//             DB::table('halaman_order')
//                 ->where('title', "order")
//                 ->update(['title' => "order", 'header_image' => $createnewFileName, 'background_image' => $createnewFileName2]);
//             // save file in databse

//             Toast::success('Update Halaman Order Sukses');
//             return back();
//         }
//     }
// }

// // Menu Order
// class MenuOrder extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(): iterable
//     {
//         return [];
//     }

//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Menu Order';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [

//             Link::make("Buat Order")->icon('bs.collection')->route('platform.order-buat'),
//             Link::make("Update Order")->icon('bs.collection')->route('platform.order-update'),
//             Link::make("Delete Order")->icon('trash')->route('platform.order-delete')
//         ];
//     }

//     /**
//      * The screen's layout elements.
//      *
//      * @return \Orchid\Screen\Layout[]|string[]
//      */
//     public function layout(): iterable
//     {
//         return [
//             Layout::view('menu_order'),
//         ];
//     }
// }

// // Order Buat
// class OrderBuat extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(): iterable
//     {
//         return [];
//     }

//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Buat Order';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Order")->icon('plus')->route('platform.order-buat'),
//             Link::make("Update Order")->icon('pencil')->route('platform.order-update'),
//             Link::make("Delete Order")->icon('trash')->route('platform.order-delete'),

//             Link::make("Tema Warna")->icon('circle')->route('platform.warna-halaman'),
//             Link::make("Background Image")->icon('image')->route('platform.halaman-order'),
//         ];
//     }

//     /**
//      * The screen's layout elements.
//      *
//      * @return \Orchid\Screen\Layout[]|string[]
//      */
//     public function layout(): iterable
//     {
//         return [
//             Layout::rows([
//                 Input::make('title')
//                     ->type('text')
//                     ->title('Judul Menu'),

//                 Input::make('deskripsi')
//                     ->type('text')
//                     ->title('Deskripsi'),

//                 Input::make('harga')
//                     ->type('text')
//                     ->title('Harga'),

//                 Input::make('waktu')
//                     ->type('text')
//                     ->title('Waktu'),

//                 Input::make('image')->type('file'),


//                 Button::make('Buat')
//                     ->method('create'),
//             ]),
//         ];
//     }

//     public function create(Request $request)
//     {
//         $title = $request->title;
//         $deskripsi = $request->deskripsi;
//         $harga = $request->harga;
//         $waktu = $request->waktu;
//         // $string_logo = $request->string_logo;

//         $this->validate($request, [
//             'title' => 'required|min:5|max:20',
//             'deskripsi' => 'required',
//             'harga' => 'required|numeric',
//             'waktu' => 'required',
//         ]);

//         if (!is_dir(storage_path("app/public/background-image/sub/"))) {
//             mkdir(storage_path("app/public/background-image/sub/"), 0755, true);
//         }

//         $newPath = storage_path('app/public/background-image/sub/');
//         if (!file_exists($newPath)) {
//             mkdir($newPath, 0755);
//         }

//         // background image no resize
//         $resize = Image::make($request->file('image'));


//         if ($request->hasFile('image')) {
//             // image hasfile
//             $filename = $request->file('image')->getClientOriginalName(); // get the file name
//             $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
//             $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
//             $createnewFileName = time() . '_' . $title . '.' . $getfileExtension; // create new random file name

//             // $image = $createnewFileName; // pass file name with column

//             $newPhotoFullPath = $newPath . $createnewFileName;
//             $resize->save($newPhotoFullPath);
//         }

//         DB::table('menu_settings')->insertOrIgnore([
//             ['title' => $title, 'deskripsi' => $deskripsi, 'harga' => $harga, 'image' => $createnewFileName, 'menu_title' => $title, 'waktu' => $waktu],
//         ]);


//         Toast::success('Buat Order Menu Baru Sukses');

//         return back();
//     }
// }

// // Order Delete
// class OrderDelete extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(): iterable
//     {
//         return [];
//     }

//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Delete Order';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Order")->icon('plus')->route('platform.order-buat'),
//             Link::make("Update Order")->icon('pencil')->route('platform.order-update'),
//             Link::make("Delete Order")->icon('trash')->route('platform.order-delete'),

//             Link::make("Tema Warna")->icon('circle')->route('platform.warna-halaman'),
//             Link::make("Background Image")->icon('image')->route('platform.halaman-order'),
//         ];
//     }

//     /**
//      * The screen's layout elements.
//      *
//      * @return \Orchid\Screen\Layout[]|string[]
//      */
//     public function layout(): iterable
//     {
//         return [
//             Layout::rows([
//                 Input::make(name: 'menu_title')
//                     ->type('text')
//                     ->title('Masukkan Judul Menu Order'),



//                 Button::make('Delete')
//                     ->method('destroy'),
//             ]),
//         ];
//     }

//     public function destroy(Request $request)
//     {
//         // ...
//         $res = Settings_menu::where('menu_title', $request->menu_title)->delete();

//         Toast::success('Delete Order Menu Sukses');

//         return back();
//     }
// }

// // Order Update
// class OrderUpdate extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(): iterable
//     {
//         return [];
//     }

//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Update Order';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Order")->icon('plus')->route('platform.order-buat'),
//             Link::make("Update Order")->icon('pencil')->route('platform.order-update'),
//             Link::make("Delete Order")->icon('trash')->route('platform.order-delete'),

//             Link::make("Tema Warna")->icon('circle')->route('platform.warna-halaman'),
//             Link::make("Background Image")->icon('image')->route('platform.halaman-order'),
//         ];
//     }

//     /**
//      * The screen's layout elements.
//      *
//      * @return \Orchid\Screen\Layout[]|string[]
//      */
//     public function layout(): iterable
//     {
//         return [
//             Layout::rows([
//                 Input::make('title')
//                     ->type('text')
//                     ->title('Judul Menu'),

//                 Input::make('deskripsi')
//                     ->type('text')
//                     ->title('Deskripsi'),

//                 Input::make('harga')
//                     ->type('text')
//                     ->title('Harga'),

//                 Input::make('waktu')
//                     ->type('text')
//                     ->title('Waktu'),

//                 Input::make('image')->type('file'),


//                 Button::make('Simpan')
//                     ->method('update'),
//             ]),
//         ];
//     }

//     public function update(Request $request)
//     {
//         $title = $request->title;
//         $deskripsi = $request->deskripsi;
//         $harga = $request->harga;
//         $waktu = $request->waktu;
//         // $string_logo = $request->string_logo;

//         $this->validate($request, [
//             'title' => 'required|min:5|max:20',
//             'deskripsi' => 'required',
//             'harga' => 'required|numeric',
//             'waktu' => 'required',
//         ]);

//         if (!is_dir(storage_path("app/public/background-image/sub/"))) {
//             mkdir(storage_path("app/public/background-image/sub/"), 0755, true);
//         }

//         $newPath = storage_path('app/public/background-image/sub/');
//         if (!file_exists($newPath)) {
//             mkdir($newPath, 0755);
//         }

//         // background image no resize
//         $resize = Image::make($request->file('image'));


//         if ($request->hasFile('image')) {
//             // image hasfile
//             $filename = $request->file('image')->getClientOriginalName(); // get the file name
//             $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
//             $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
//             $createnewFileName = time() . '_' . $title . '.' . $getfileExtension; // create new random file name

//             // $image = $createnewFileName; // pass file name with column

//             $newPhotoFullPath = $newPath . $createnewFileName;
//             $resize->save($newPhotoFullPath);
//         }


//         DB::table('menu_settings')
//             ->where('menu_title', $title)
//             ->update(['title' => $title, 'deskripsi' => $deskripsi, 'harga' => $harga, 'image' => $createnewFileName, 'menu_title' => $title, 'waktu' => $waktu,]);


//         Toast::success('Update Order Menu Sukses');

//         return back();
//     }
// }
