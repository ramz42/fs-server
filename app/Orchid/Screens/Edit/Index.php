<?php

namespace App\Orchid\Screens\Edit;

use App\Models\Background;
use App\Models\Layout as ModelsLayout;
use App\Models\Filter as ModelsFilter;
use App\Models\LayoutCustome;
use App\Models\Sticker_model;
use Illuminate\Support\Facades\Cookie;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\TD;
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


// // ===========================
// //      Table Background
// // ===========================
// class TableBackground extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(): array
//     {
//         $background = Background::latest()->paginate(perPage: 20);
//         return [
//             'background' => $background
//         ];
//     }


//     /**
//      * The name of the screen displayed in the header.
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Background Table';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Background")->icon('plus')->route('platform.buat-background'),
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
//             Layout::table('background', [
//                 TD::make('nama')->align(TD::ALIGN_CENTER)->render(function ($background) {
//                     return substr($background->nama, 0, 30);
//                 }),

//                 TD::make('gambar')->align(TD::ALIGN_CENTER)->render(function ($background) {
//                     return "<center><img src='http://127.0.0.1:8000/storage/background/{$background->image}' width='150' height='150'></center>";
//                 }),

//                 TD::make('warna')->align(TD::ALIGN_CENTER)->render(function ($background) {
//                     return substr($background->warna, 0, 30);
//                 }),

//                 TD::make('status')->align(TD::ALIGN_CENTER)->render(function ($background) {
//                     return substr($background->status, 0, 30);
//                 }),

//                 TD::make('update')->align(TD::ALIGN_CENTER)->render(
//                     fn($background) =>  Link::make('Update')
//                         ->icon('pencil')->route('platform.update-background', [$background]),
//                 ),
//             ]),


//         ];
//     }
// }

// // ===========================
// //        Table Layout
// // ===========================
// class TableLayout extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(): array
//     {
//         $layout = ModelsLayout::latest()->paginate(perPage: 20);
//         return [
//             'layout' => $layout
//         ];
//     }


//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Layout';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Layout")->icon('plus')->route('platform.buat-layout'),
//             Link::make("List Layout")->icon('list')->route('platform.layout'),
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
//             Layout::table('layout', [
//                 TD::make('nama')->align(TD::ALIGN_CENTER)->render(function ($layout) {
//                     return substr($layout->nama, 0, 30);
//                 }),

//                 TD::make('gambar')->align(TD::ALIGN_CENTER)->render(function ($layout) {
//                     return "<center><img src='http://127.0.0.1:8000/storage/layout/{$layout->image}' width='150' height='150'></center>";
//                 }),

//                 TD::make('status')->align(TD::ALIGN_CENTER)->render(function ($layout) {
//                     return substr($layout->status, 0, 30);
//                 }),

//                 TD::make('jumlah kotak')->align(TD::ALIGN_CENTER)->render(function ($layout) {
//                     return substr($layout->jumlah_kotak, 0, 30);
//                 }),

//                 TD::make('edit status')->align(TD::ALIGN_CENTER)->render(
//                     fn($layout) =>  Link::make('Edit Status')
//                         ->icon('pencil')->route('platform.update-layout', [$layout]),
//                 ),
//             ]),
//         ];
//     }

//     public function update(Request $request)
//     {
//         // ...
//         $layout = new ModelsLayout();
//         $layout->nama = $request->nama;
//         $layout->status = $request->status;
//         $layout->warna = $request->warna;

//         DB::table('layout')
//             ->where('nama', $layout->nama)
//             ->update(['nama' => $layout->nama, 'status' => $layout->status, 'warna' => $layout->warna]);

//         Toast::success('Update Filter Baru Berhasil');
//         return back();
//     }
// }

// // ===========================
// //        Buat Layout
// // ===========================
// class BuatLayout extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(): array
//     {
//         return [
//             // ...

//         ];
//     }


//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Layout';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Layout")->icon('plus')->route('platform.buat-layout'),
//             Link::make("List Layout")->icon('list')->route('platform.layout'),
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
//                 Input::make('nama')
//                     ->type('text')
//                     ->title('Nama Layout')->help('Masukkan nama layout'),

//                 Input::make('panjang')
//                     ->type('number')
//                     ->title('Tinggi / Panjang')->help('Ukuran Pixels'),

//                 Input::make('lebar')
//                     ->type('number')
//                     ->title('Lebar')->help('Ukuran Pixels'),

//                 Button::make('Simpan')
//                     ->method('create'),
//             ]),
//         ];
//     }

//     public function create(Request $request)
//     {
//         // ...
//         Cookie::forget('nama');
//         Cookie::forget('panjang');
//         Cookie::forget('lebar');
//         Cookie::forget('type');

//         Cookie::forget('top');
//         Cookie::forget('left');
//         Cookie::forget('height');
//         Cookie::forget('width');
//         Cookie::forget('kategori');

//         Cookie::forget('top1');
//         Cookie::forget('left1');
//         Cookie::forget('height1');
//         Cookie::forget('width1');
//         Cookie::forget('kategori1');

//         Cookie::forget('top2');
//         Cookie::forget('left2');
//         Cookie::forget('height2');
//         Cookie::forget('width2');
//         Cookie::forget('kategori2');

//         Cookie::forget('top3');
//         Cookie::forget('left3');
//         Cookie::forget('height3');
//         Cookie::forget('width3');
//         Cookie::forget('kategori3');

//         Cookie::forget('top4');
//         Cookie::forget('left4');
//         Cookie::forget('height4');
//         Cookie::forget('width4');
//         Cookie::forget('kategori4');

//         // Set Cookies ===
//         Cookie::queue('nama', $request->nama, 50);
//         Cookie::queue('panjang', $request->panjang, 120);
//         Cookie::queue('lebar', $request->lebar, 120);

//         Cookie::queue('kategori', 'Photo', 120);
//         Cookie::queue('type', 0, 120);


//         Alert::success('Berhasil Buat Draf Layout Baru');
//         return redirect()->route('platform.kostum-layout');
//     }
// }

// // ===========================
// //        Kostum Layout
// // ===========================
// class KostumLayout extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(Request $request): array
//     {
//         return [
//             // ========================================
//             // Parameter request dari Class BuatLayout
//             // ========================================
//             $nama = $request->cookie('nama'),
//             $panjang = $request->cookie('panjang'),
//             $lebar = $request->cookie('lebar'),
//             $type = $request->cookie('type'),
//             $kategori = $request->cookie('kategori'),

//             // cookies generate kotak frame
//             $top = $request->cookie('top'),
//             $left = $request->cookie('left'),
//             $height = $request->cookie('height'),
//             $width = $request->cookie('width'),

//             $top1 = $request->cookie('top1'),
//             $left1 = $request->cookie('left1'),
//             $height1 = $request->cookie('height1'),
//             $width1 = $request->cookie('width1'),

//             $top2 = $request->cookie('top2'),
//             $left2 = $request->cookie('left2'),
//             $height2 = $request->cookie('height2'),
//             $width2 = $request->cookie('width2'),

//             $top3 = $request->cookie('top3'),
//             $left3 = $request->cookie('left3'),
//             $height3 = $request->cookie('height3'),
//             $width3 = $request->cookie('width3'),

//             $top4 = $request->cookie('top4'),
//             $left4 = $request->cookie('left4'),
//             $height4 = $request->cookie('height4'),
//             $width4 = $request->cookie('width4'),

//             $top5 = $request->cookie('top5'),
//             $left5 = $request->cookie('left5'),
//             $height5 = $request->cookie('height5'),
//             $width5 = $request->cookie('width5'),

//             $top6 = $request->cookie('top6'),
//             $left6 = $request->cookie('left6'),
//             $height6 = $request->cookie('height6'),
//             $width6 = $request->cookie('width6'),

//             $top7 = $request->cookie('top7'),
//             $left7 = $request->cookie('left7'),
//             $height7 = $request->cookie('height7'),
//             $width7 = $request->cookie('width7'),

//             $top8 = $request->cookie('top8'),
//             $left8 = $request->cookie('left8'),
//             $height8 = $request->cookie('height8'),
//             $width8 = $request->cookie('width8'),

//             $top9 = $request->cookie('top9'),
//             $left9 = $request->cookie('left9'),
//             $height9 = $request->cookie('height9'),
//             $width9 = $request->cookie('width9'),

//             $logo_top = $request->cookie('logo_top'),
//             $logo_left = $request->cookie('logo_left'),
//             $logo_height = $request->cookie('logo_height'),
//             $logo_width = $request->cookie('logo_width'),

//             'nama' => $nama,
//             'panjang' => $panjang,
//             'lebar' => $lebar,
//             'type' => $type,
//             'kategori' => $kategori,

//             'top' => $top,
//             'left' => $left,
//             'height' => $height,
//             'width' => $width,

//             'top1' => $top1,
//             'left1' => $left1,
//             'height1' => $height1,
//             'width1' => $width1,

//             'top2' => $top2,
//             'left2' => $left2,
//             'height2' => $height2,
//             'width2' => $width2,

//             'top3' => $top3,
//             'left3' => $left3,
//             'height3' => $height3,
//             'width3' => $width3,

//             'top4' => $top4,
//             'left4' => $left4,
//             'height4' => $height4,
//             'width4' => $width4,

//             'top5' => $top5,
//             'left5' => $left5,
//             'height5' => $height5,
//             'width5' => $width5,

//             'top6' => $top6,
//             'left6' => $left6,
//             'height6' => $height6,
//             'width6' => $width6,

//             'top7' => $top7,
//             'left7' => $left7,
//             'height7' => $height7,
//             'width7' => $width7,

//             'top8' => $top8,
//             'left8' => $left8,
//             'height8' => $height8,
//             'width8' => $width8,

//             'top9' => $top9,
//             'left9' => $left9,
//             'height9' => $height9,
//             'width9' => $width9,

//             'logo_top' => $logo_top,
//             'logo_left' => $logo_left,
//             'logo_height' => $logo_height,
//             'logo_width' => $logo_width,
//         ];
//     }


//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Layout Kostum';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Layout")->icon('plus')->route('platform.buat-layout'),
//             Link::make("List Layout")->icon('list')->route('platform.layout'),
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
//             Layout::columns([

//                 Layout::view('dashboard.edit-photo.kostum_layout'),

//                 Layout::rows([
//                     Input::make('top')
//                         ->type('number')
//                         ->title('Top')->help('Ukuran Pixels'),

//                     Input::make('left')
//                         ->type('number')
//                         ->title('Left')->help('Ukuran Pixels'),

//                     Input::make('height')
//                         ->type('number')
//                         ->title('Height')->help('Ukuran Pixels'),

//                     Input::make('width')
//                         ->type('number')
//                         ->title('Width')->help('Ukuran Pixels'),

//                     Select::make('kategori')
//                         ->options([
//                             'Photo'   => 'Photo',
//                             'Logo' => 'Logo',
//                         ])
//                         ->title('Pilih Kategori')
//                         ->help('Pilih Kategori Frame'),

//                     Button::make('Generate Box')
//                         ->method('generate')->icon('gear'),

//                     Button::make('Tambah Kotak')
//                         ->method('addKotak')->icon('box'),

//                     Button::make('Simpan Layout')
//                         ->method('store')->icon('save'),
//                 ]),

//             ]),

//         ];
//     }

//     // generate / update
//     public function generate(Request $request)
//     {
//         // Set Cookies Data
//         Cookie::queue('top', $request->top, 120);
//         Cookie::queue('left', $request->left, 120);
//         Cookie::queue('height', $request->height, 120);
//         Cookie::queue('width', $request->width, 120);
//         Cookie::queue('kategori', $request->kategori, 120);

//         // ...
//         Alert::success('Berhasil Generate Layout');
//         return redirect()->route('platform.kostum-layout');
//     }

//     public function addKotak(Request $request)
//     {
//         // ...
//         $type_old = $request->cookie('type');

//         // Set Cookies Data
//         if ($request->cookie('kategori') == 'Logo') {
//             # code...
//             Cookie::queue('type', 10, 120);
//             Cookie::queue('logo_top', $request->top, 120);
//             Cookie::queue('logo_left', $request->left, 120);
//             Cookie::queue('logo_height', $request->height, 120);
//             Cookie::queue('logo_width', $request->width, 120);
//             Cookie::queue('kategori', $request->kategori, 120);
//         }

//         if ($type_old == 0) {
//             # code...
//             Cookie::queue('type', 1, 120);
//             Cookie::queue('top1', $request->top, 120);
//             Cookie::queue('left1', $request->left, 120);
//             Cookie::queue('height1', $request->height, 120);
//             Cookie::queue('width1', $request->width, 120);
//             Cookie::queue('kategori1', $request->kategori, 120);
//         }
//         if ($type_old == 1) {
//             # code...
//             Cookie::queue('type', 2, 120);
//             Cookie::queue('top2', $request->top, 120);
//             Cookie::queue('left2', $request->left, 120);
//             Cookie::queue('height2', $request->height, 120);
//             Cookie::queue('width2', $request->width, 120);
//             Cookie::queue('kategori2', $request->kategori, 120);
//         }
//         if ($type_old == 2) {
//             # code...
//             Cookie::queue('type', 3, 120);
//             Cookie::queue('top3', $request->top, 120);
//             Cookie::queue('left3', $request->left, 120);
//             Cookie::queue('height3', $request->height, 120);
//             Cookie::queue('width3', $request->width, 120);
//             Cookie::queue('kategori3', $request->kategori, 120);
//         }
//         if ($type_old == 3) {
//             # code...
//             Cookie::queue('type', 4, 120);
//             Cookie::queue('top4', $request->top, 120);
//             Cookie::queue('left4', $request->left, 120);
//             Cookie::queue('height4', $request->height, 120);
//             Cookie::queue('width4', $request->width, 120);
//             Cookie::queue('kategori4', $request->kategori, 120);
//         }

//         if ($type_old == 4) {
//             # code...
//             Cookie::queue('type', 5, 120);
//             Cookie::queue('top5', $request->top, 120);
//             Cookie::queue('left5', $request->left, 120);
//             Cookie::queue('height5', $request->height, 120);
//             Cookie::queue('width5', $request->width, 120);
//             Cookie::queue('kategori5', $request->kategori, 120);
//         }

//         if ($type_old == 5) {
//             # code...
//             Cookie::queue('type', 6, 120);
//             Cookie::queue('top6', $request->top, 120);
//             Cookie::queue('left6', $request->left, 120);
//             Cookie::queue('height6', $request->height, 120);
//             Cookie::queue('width6', $request->width, 120);
//             Cookie::queue('kategori6', $request->kategori, 120);
//         }

//         if ($type_old == 6) {
//             # code...
//             Cookie::queue('type', 7, 120);
//             Cookie::queue('top7', $request->top, 120);
//             Cookie::queue('left7', $request->left, 120);
//             Cookie::queue('height7', $request->height, 120);
//             Cookie::queue('width7', $request->width, 120);
//             Cookie::queue('kategori7', $request->kategori, 120);
//         }

//         if ($type_old == 7) {
//             # code...
//             Cookie::queue('type', 8, 120);
//             Cookie::queue('top8', $request->top, 120);
//             Cookie::queue('left8', $request->left, 120);
//             Cookie::queue('height8', $request->height, 120);
//             Cookie::queue('width8', $request->width, 120);
//             Cookie::queue('kategori8', $request->kategori, 120);
//         }

//         if ($type_old == 8) {
//             # code...
//             Cookie::queue('type', 9, 120);
//             Cookie::queue('top9', $request->top, 120);
//             Cookie::queue('left9', $request->left, 120);
//             Cookie::queue('height9', $request->height, 120);
//             Cookie::queue('width9', $request->width, 120);
//             Cookie::queue('kategori9', $request->kategori, 120);
//         }

//         if ($type_old == 9) {
//             # code...
//         }

//         // ...

//         Alert::success('Berhasil Add Box');
//         return redirect()->route('platform.kostum-layout');
//     }

//     public function store(Request $request)
//     {
//         // ...
//         $layout = new LayoutCustome();
//         $layout->nama = $request->nama;
//         $layout->panjang = $request->panjang;
//         $layout->lebar = $request->lebar;


//         // Get Cookies
//         $layout->nama = $request->cookie('nama');
//         $layout->panjang = $request->cookie('panjang');
//         $layout->lebar = $request->cookie('lebar');
//         // $layout->nama = $request->cookie('type');
//         // $layout->nama = $request->cookie('kategori');

//         // cookies generate kotak frame
//         // $layout->kotak1_top = $request->cookie('top');
//         // $layout->kotak1_left = $request->cookie('left');
//         // $layout->kotak1_height = $request->cookie('height');
//         // $layout->kotak1_width = $request->cookie('width');

//         $layout->kotak1_top = $request->cookie('top1');
//         $layout->kotak1_left = $request->cookie('left1');
//         $layout->kotak1_height = $request->cookie('height1');
//         $layout->kotak1_width = $request->cookie('width1');

//         $layout->kotak2_top = $request->cookie('top2');
//         $layout->kotak2_left = $request->cookie('left2');
//         $layout->kotak2_height = $request->cookie('height2');
//         $layout->kotak2_width = $request->cookie('width2');

//         $layout->kotak3_top = $request->cookie('top3');
//         $layout->kotak3_left = $request->cookie('left3');
//         $layout->kotak3_height = $request->cookie('height3');
//         $layout->kotak3_width = $request->cookie('width3');

//         $layout->kotak4_top = $request->cookie('top4');
//         $layout->kotak4_left = $request->cookie('left4');
//         $layout->kotak4_height = $request->cookie('height4');
//         $layout->kotak4_width = $request->cookie('width4');

//         $layout->kotak5_top = $request->cookie('top5');
//         $layout->kotak5_left = $request->cookie('left5');
//         $layout->kotak5_height = $request->cookie('height5');
//         $layout->kotak5_width = $request->cookie('width5');

//         $layout->kotak6_top = $request->cookie('top6');
//         $layout->kotak6_left = $request->cookie('left6');
//         $layout->kotak6_height = $request->cookie('height6');
//         $layout->kotak6_width = $request->cookie('width6');

//         $layout->kotak7_top = $request->cookie('top7');
//         $layout->kotak7_left = $request->cookie('left7');
//         $layout->kotak7_height = $request->cookie('height7');
//         $layout->kotak7_width = $request->cookie('width7');

//         $layout->kotak8_top = $request->cookie('top8');
//         $layout->kotak8_left = $request->cookie('left8');
//         $layout->kotak8_height = $request->cookie('height8');
//         $layout->kotak8_width = $request->cookie('width8');

//         $layout->kotak9_top = $request->cookie('top9');
//         $layout->kotak9_left = $request->cookie('left9');
//         $layout->kotak9_height = $request->cookie('height9');
//         $layout->kotak9_width = $request->cookie('width9');

//         $layout->logo_top = $request->cookie('logo_top');
//         $layout->logo_left = $request->cookie('logo_left');
//         $layout->logo_height = $request->cookie('logo_height');
//         $layout->logo_width = $request->cookie('logo_width');

//         if ($layout->save()) {
//             # code...
//             Alert::success('Berhasil Simpan Layout');
//             return redirect()->route('platform.buat-layout');
//         }
//     }
// }

// // ===========================
// //        Table Sticker
// // ===========================
// class TableSticker extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(): array
//     {
//         $sticker = Sticker_model::latest()->paginate(perPage: 20);
//         return [
//             'sticker' => $sticker
//         ];
//     }


//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Sticker Table';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Sticker")->icon('plus')->route('platform.buat-sticker'),
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
//             Layout::table('sticker', [
//                 TD::make('nama')->align(TD::ALIGN_CENTER)->render(function ($sticker) {
//                     return substr($sticker->nama, 0, 30);
//                 }),

//                 TD::make('gambar')->align(TD::ALIGN_CENTER)->render(function ($sticker) {
//                     return "<center><img src='http://127.0.0.1:8000/storage/sticker/{$sticker->nama_img}' width='150' height='150' style='margin: 0 auto; object-fit: contain;'></center>";
//                 }),

//                 TD::make('status')->align(TD::ALIGN_CENTER)->render(function ($sticker) {
//                     return substr($sticker->status, 0, 30);
//                 }),

//                 TD::make('update')->align(TD::ALIGN_CENTER)->render(
//                     fn($sticker) =>  Link::make('Update')
//                         ->icon('pencil')->route('platform.update-sticker', [$sticker]),
//                 ),
//             ]),


//         ];
//     }
// }

// // ===========================
// //      Update Background
// // ===========================
// class UpdateBackground extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(Background $background): iterable
//     {

//         return [
//             'background' => $background
//         ];
//     }

//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Update Background';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Background")->icon('plus')->route('platform.buat-background'),
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


//                 Input::make('background.nama')
//                     ->type('text')
//                     ->title('Nama Background'),

//                 Input::make('status')
//                     ->type('text')
//                     ->title('Status Background'),

//                 Input::make('warna')->type('color')
//                     ->title('Warna Background'),

//                 Input::make('image')->type('file')
//                     ->title('Gambar Background'),

//                 Button::make('Simpan Update')
//                     ->method('update'),
//             ]),
//         ];
//     }

//     // ...

//     public function update(Request $request)
//     {
//         // ...
//         $background = new Background();
//         $background->nama = $request->nama;
//         $background->warna = $request->warna;
//         $background->status = $request->status;

//         if (!is_dir(storage_path("app/public/background/"))) {
//             mkdir(storage_path("app/public/background/"), 0755, true);
//         }

//         $newPath = storage_path("app/public/background/");
//         if (!file_exists($newPath)) {
//             mkdir($newPath, 0755);
//         }

//         $resize = Image::make($request->file('image'))->encode('jpg');

//         if ($request->hasFile('image')) {
//             $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
//             $createnewFileName = time() . '_' . $background->nama . '.' . $getfileExtension; // create new random file name
//             $newPhotoFullPath = $newPath . $createnewFileName;
//             $resize->save($newPhotoFullPath);

//             // insert sticker
//             DB::table('background')->where('nama', $background->nama)->update(['nama' => $background->nama,  'image' => $createnewFileName, 'warna' => $background->warna, 'status' => $background->status]);
//             // save file in databse

//             Alert::info('Anda Berhasil Update Background');

//             // Toast::success('Update Layout Status Berhasil');
//             return redirect()->route('platform.table-background');
//         }
//     }
// }

// // Update Filter
// class UpdateFilter extends Screen
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
//         return 'Update Filter';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Filter")->icon('plus')->route('platform.buat-filter'),
//             Link::make("Update Filter")->icon('pencil')->route('platform.update-filter'),
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

//                 Input::make('nama')
//                     ->type('text')
//                     ->title('Nama Filter'),

//                 Input::make('status')
//                     ->type('text')
//                     ->title('Status Filter'),

//                 Input::make('warna')->type('color')
//                     ->title('Warna Filter'),


//                 Button::make('Simpan')
//                     ->method('update'),
//             ]),
//         ];
//     }

//     /**
//      * Update the specified resource in storage.
//      */

//     public function update(Request $request)
//     {
//         // ...
//         $filter = new ModelsFilter();
//         $filter->nama = $request->nama;
//         $filter->status = $request->status;
//         $filter->warna = $request->warna;

//         DB::table('filter')
//             ->where('nama', $filter->nama)
//             ->update(['nama' => $filter->nama, 'status' => $filter->status, 'warna' => $filter->warna]);

//         Toast::success('Update Filter Baru Berhasil');
//         return back();
//     }
// }

// // Update Layout
// class UpdateLayout extends Screen
// {
//     /**
//      * Fetch data to be displayed on the screen.
//      *
//      * @return array
//      */
//     public function query(ModelsLayout $layout): iterable
//     {

//         return [
//             'layout' => $layout
//         ];
//     }

//     /**
//      * The name of the screen displayed in the header.
//      *
//      * @return string|null
//      */
//     public function name(): ?string
//     {
//         return 'Update Layout';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Layout Table")->icon('layer')->route('platform.layout'),
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

//                 Input::make('layout.nama')
//                     ->type('text')
//                     ->title('Nama Layout')->placeholder('Nama Layout'),

//                 Input::make('layout.status')
//                     ->type('text')
//                     ->title('Status Layout')->placeholder('Status Layout'),

//                 Button::make('Simpan')
//                     ->method('update'),
//             ]),
//         ];
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(ModelsLayout $layout, Request $request)
//     {
//         // ...
//         $layout->fill($request->get('layout'))->save();
//         Alert::info('Anda Berhasil Update Layout Status');

//         // Toast::success('Update Layout Status Berhasil');
//         return redirect()->route('platform.layout');
//     }
// }

// // Update Sticker
// class UpdateSticker extends Screen
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
//         return 'Update Sticker';
//     }

//     /**
//      * The screen's action buttons.
//      *
//      * @return \Orchid\Screen\Action[]
//      */
//     public function commandBar(): iterable
//     {
//         return [
//             Link::make("Buat Sticker")->icon('plus')->route('platform.buat-sticker'),
//             Link::make("Update Sticker")->icon('pencil')->route('platform.update-sticker'),
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



//                 Input::make('nama_sticker')
//                     ->type('text')
//                     ->title('Nama Sticker'),

//                 Input::make('status')
//                     ->type('text')
//                     ->title('Status Sticker'),

//                 Input::make('gambar_sticker')->type('file')
//                     ->title('Gambar Sticker'),


//                 Button::make('Simpan')
//                     ->method('update'),
//             ]),
//         ];
//     }

//     // ...
//     public function update(Request $request)
//     {
//         // ...
//         $sticker = new Sticker_model();
//         $sticker->nama = $request->nama_sticker;
//         $sticker->status = $request->status;

//         // $fileName = $request->get('gambar_sticker') . '.png';

//         if (!is_dir(storage_path("app/public/sticker/"))) {
//             mkdir(storage_path("app/public/sticker/"), 0755, true);
//         }

//         $newPath = storage_path("app/public/sticker/");
//         if (!file_exists($newPath)) {
//             mkdir($newPath, 0755);
//         }

//         $resize = Image::make($request->file('gambar_sticker'))->encode('jpg');

//         if ($request->hasFile('gambar_sticker')) {
//             $filename = $request->file('gambar_sticker')->getClientOriginalName(); // get the file name
//             $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
//             $getfileExtension = $request->file('gambar_sticker')->getClientOriginalExtension(); // get the file extension
//             $createnewFileName = time() . '-' . 'sticker' . '.' . $getfileExtension; // create new random file name
//             $sticker->nama_img = $createnewFileName; // pass file name with column
//             $newPhotoFullPath = $newPath . $createnewFileName;
//             $resize->save($newPhotoFullPath);


//             DB::table('sticker')
//                 ->where('nama', $sticker->nama)
//                 ->update(['nama' => $sticker->nama, 'status' => $sticker->status, 'nama_img' => $createnewFileName]);

//             Toast::success('Update Sticker Berhasil');
//             return back();
//         }
//     }
// }
