<?php

namespace App\Orchid\Screens\Settings;

use App\Models\Background;
use App\Models\Invoice;
use App\Models\Sticker_model;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;
use App\Models\Filter as ModelsFilter;

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

// Buat Background
class BuatBackground extends Screen
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
        return 'Buat Background';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make("Buat Background")->icon('plus')->route('platform.buat-background'),
            Link::make("Update Background")->icon('pencil')->route('platform.update-background'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('nama')
                    ->type('text')
                    ->title('Nama Background'),
                Input::make('status')
                    ->type('text')
                    ->title('Status Background'),
                Input::make('warna')->type('color')
                    ->title('Warna Background'),
                Input::make('image')->type('file')
                    ->title('Gambar Background'),
                Button::make('Simpan')
                    ->method('store'),
            ]),
        ];
    }

    // ...

    public function store(Request $request)
    {
        // ...
        $background = new Background();
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

        $resize = Image::make($request->file('image'))->encode('jpg');

        if ($request->hasFile('image')) {
            $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $background->nama . '.' . $getfileExtension; // create new random file name
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

            DB::table('background')->insert(['nama' => $background->nama,  'image' => $createnewFileName, 'warna' => $background->warna, 'status' => $background->status]);

            Toast::success('Buat Background Baru Berhasil');
            return back();
        }
    }
}

// Buat Filter
class BuatFilter extends Screen
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
        return 'Buat Filter';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make("Buat Filter")->icon('plus')->route('platform.buat-filter'),
            Link::make("Update Filter")->icon('pencil')->route('platform.update-filter'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([

                Input::make('nama')
                    ->type('text')
                    ->title('Nama Filter'),

                Input::make('status')
                    ->type('text')
                    ->title('Status Filter'),

                Input::make('warna')->type('color')
                    ->title('Warna Filter'),


                Button::make('Simpan')
                    ->method('store'),
            ]),
        ];
    }

    // ...
    public function store(Request $request)
    {
        // ...
        $filter = new ModelsFilter();
        $filter->nama = $request->nama;
        $filter->status = $request->status;
        $filter->warna = $request->warna;


        // insert sticker
        DB::table('filter')->insertOrIgnore(['nama' => $filter->nama,  'status' => $filter->status, 'warna' => $filter->warna]);
        // save file in databse
        Toast::success('Buat Filter Baru Berhasil');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // get all stickers
        return ModelsFilter::all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ...
        $id = $request->id;
        $filter =  ModelsFilter::find($id);
        $filter->nama = $request->nama;
        $filter->status = $request->status;
        $filter->warna = $request->warna;

        $filter->save();
        $filter->update($request->all());

        return response()->json($filter);
    }
}

// Buat Sticker
class BuatSticker extends Screen
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
        return 'Buat Sticker';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make("Buat Sticker")->icon('plus')->route('platform.buat-sticker'),
            Link::make("Update Sticker")->icon('pencil')->route('platform.update-sticker'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([


                Input::make('nama_sticker')
                    ->type('text')
                    ->title('Nama Sticker'),

                Input::make('status')
                    ->type('text')
                    ->title('Status Sticker'),

                Input::make('gambar_sticker')->type('file')
                    ->title('Gambar Sticker'),


                Button::make('Simpan')
                    ->method('store'),
            ]),
        ];
    }

    // ...

    public function store(Request $request)
    {
        // ...
        $sticker = new Sticker_model();
        $sticker->nama = $request->nama_sticker;
        $sticker->status = $request->status;

        if (!is_dir(storage_path("app/public/sticker/"))) {
            mkdir(storage_path("app/public/sticker/"), 0755, true);
        }

        $newPath = storage_path("app/public/sticker/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        $resize = Image::make($request->file('gambar_sticker'))->encode('jpg');

        if ($request->hasFile('gambar_sticker')) {
            $getfileExtension = $request->file('gambar_sticker')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $sticker->nama . '.' . $getfileExtension; // create new random file name
            $sticker->nama_img = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

            // insert sticker
            DB::table('sticker')->insert(['nama' => $sticker->nama,  'nama_img' => $createnewFileName, 'status' => $sticker->status]);
            // save file in databse

            Toast::success('Buat Sticker Baru Berhasil');
            return back();
        }
    }
}

// Halaman Settings
class HalamanSettings extends Screen
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
        return 'Halaman Settings';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            
            Link::make("Halaman Settings")->icon('gear')->route('platform.halaman-settings'),
            Link::make("Laporan Invoice")->icon('pencil')->route('platform.laporan-invoices'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([
                Input::make('pin')
                    ->type('text')
                    ->title('Pin'),

                Input::make('server_key')
                    ->type('text')
                    ->title('Server Key'),

                Input::make('judul')
                    ->type('text')
                    ->title('Judul'),

                Input::make('deskripsi')
                    ->type('text')
                    ->title('Deskripsi'),

                Input::make('string_logo')
                    ->type('text')
                    ->title('String Logo'),

                Input::make('image')->type('file'),


                Button::make('Simpan')
                    ->method('simpanSettings'),
            ]),

        ];
    }

    public function simpanSettings(Request $request)
    {
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;
        $pin = $request->pin;
        $type = $request->type;
        $server_key = $request->server_key;
        $string_logo = $request->string_logo;

        $this->validate($request, [
            'judul' => 'required|min:5|max:20',
            'deskripsi' => 'required',
            'pin' => 'required|numeric',

            'server_key' => 'required|min:4|max:4',
            'string_logo' => 'required|max:20',
        ]);


        # code...
        if (!is_dir(storage_path("app/public/background-image/main/"))) {
            mkdir(storage_path("app/public/background-image/main/"), 0755, true);
        }

        $newPath = storage_path('app/public/background-image/main/');
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        $resize = Image::make($request->file('image'));


        if ($request->hasFile('image')) {

            $filename = $request->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '_' . $judul . '.' . $getfileExtension; // create new random file name


            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        // update settings db
        DB::table('settings')
            ->where('type', "main")
            ->update(['judul' => $request->judul, 'deskripsi' => $request->deskripsi, 'pin' => $request->pin, 'type' => "main", 'server_key' => $request->server_key, 'image' => $createnewFileName, 'string_logo' => $request->string_logo]);

        Toast::success('Update Halaman Setting Sukses');

        return back();
    }
} 

// Laporan Invoices
class LaporanInvoices extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        $invoices = Invoice::latest()->paginate(10);
        return [
            'invoices' => $invoices
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Laporan Invoices';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make("Halaman Settings")->icon('gear')->route('platform.halaman-settings'),
            Link::make("Laporan Invoice")->icon('pencil')->route('platform.laporan-invoices'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('invoices', [
                TD::make('tanggal')->render(function ($invoices) {
                    return substr($invoices->tanggal, 0, 30);
                }),
                TD::make('no invoice')->render(function ($invoices) {
                    return substr($invoices->no_invoice, 0, 40);
                }),
                TD::make('code')->render(function ($invoices) {
                    return substr($invoices->code, 0, 40);
                }),
                TD::make('paket')->render(function ($invoices) {
                    return substr($invoices->paket, 0, 30);
                }),
                TD::make('customer')->render(function ($invoices) {
                    return substr($invoices->customer, 0, 30);
                }),
                TD::make('email')->render(function ($invoices): string {
                    return substr($invoices->email, 0, 30);
                }),

                TD::make('no telp')->render(function ($invoices) {
                    return substr($invoices->no_telp, 0, 30);
                }),

                TD::make('harga')->render(function ($invoices) {
                    return substr($invoices->harga, 0, length: 30);
                }),

                TD::make('created at')->render(function ($invoices) {
                    return substr($invoices->created_at, 0, 30);
                }),

                TD::make('Aksi')->render(
                    fn() =>  Button::make('print')
                        ->icon('printer')
                        ->modal(
                            'exampleModal',
                        )->method('action'),
                ),
            ]),

            // modal demo
            Layout::modal('exampleModal', [
                Layout::rows([]),
            ]),

        ];
    }

    public function action(): void
    {
        Layout::modal('exampleModal', [
            Layout::rows([]),
        ]);
    }
}

// Warna Halaman
class WarnaHalaman extends Screen
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
        return 'Tema Warna';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            
            Link::make("Buat Order")->icon('plus')->route('platform.order-buat'),
            Link::make("Update Order")->icon('pencil')->route('platform.order-update'),
            Link::make("Delete Order")->icon('trash')->route('platform.order-delete'),

            Link::make("Tema Warna")->icon('circle')->route('platform.warna-halaman'),
            Link::make("Background Image")->icon('image')->route('platform.halaman-order'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([

                Input::make('bg_warna_wave')->type('color')
                    ->title('Warna Halaman Primer'),


                Input::make('warna1')->type('color')
                    ->title('Warna Halaman Pertama'),


                Input::make('warna2')->type('color')
                    ->title('Warna Halaman Kedua'),

                Button::make('Simpan')
                    ->method('simpanSettingsOrder'),
            ]),
        ];
    }

    // simpan order
    public function simpanSettingsOrder(Request $request)
    {
        $bg_warna_wave = $request->bg_warna_wave;
        $warna1 = $request->warna1;
        $warna2 = $request->warna2;

        $this->validate($request, [
            'bg_warna_wave' => 'required',
            'warna1' => 'required',
            'warna2' => 'required',
        ]);

        // update settings db
        DB::table(table: 'main_color')
            ->where('id', 1)
            ->update(['bg_warna_wave' => $bg_warna_wave, 'warna1' => $warna1, 'warna2' => $warna2]);

        Toast::success('Update Warna Halaman Sukses');

        return back();
    }
}