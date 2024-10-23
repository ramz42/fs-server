<?php

namespace App\Orchid\Screens\Order;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;

class OrderBuat extends Screen
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
        return 'Buat Order';
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
                Input::make('title')
                    ->type('text')
                    ->title('Judul Menu'),

                Input::make('deskripsi')
                    ->type('text')
                    ->title('Deskripsi'),

                Input::make('harga')
                    ->type('text')
                    ->title('Harga'),

                Input::make('waktu')
                    ->type('text')
                    ->title('Waktu'),

                Input::make('image')->type('file'),


                Button::make('Buat')
                    ->method('create'),
            ]),
        ];
    }

    public function create(Request $request)
    {
        $title = $request->title;
        $deskripsi = $request->deskripsi;
        $harga = $request->harga;
        $waktu = $request->waktu;
        // $string_logo = $request->string_logo;

        $this->validate($request, [
            'title' => 'required|min:5|max:20',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'waktu' => 'required',
        ]);

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
            $createnewFileName = time() . '_' . $title . '.' . $getfileExtension; // create new random file name

            // $image = $createnewFileName; // pass file name with column

            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        DB::table('menu_settings')->insertOrIgnore([
            ['title' => $title, 'deskripsi' => $deskripsi, 'harga' => $harga, 'image' => $createnewFileName, 'menu_title' => $title, 'waktu' => $waktu],
        ]);
      

        Toast::success('Buat Order Menu Baru Sukses');

        return back();
    }

}
