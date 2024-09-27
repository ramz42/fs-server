<?php

namespace App\Orchid\Screens;

use App\Models\Background;
use App\Models\Sticker_model;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;

class UpdateBackground extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Background $background): iterable
    {

        return [
            'background' => $background
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Update Background';
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


                Input::make('background.nama')
                    ->type('text')
                    ->title('Nama Background'),

                Input::make('status')
                    ->type('text')
                    ->title('Status Background'),

                Input::make('warna')->type('color')
                    ->title('Warna Background'),

                Input::make('image')->type('file')
                    ->title('Gambar Background'),

                Button::make('Simpan Update')
                    ->method('update'),
            ]),
        ];
    }

    // ...

    public function update(Request $request)
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

            // insert sticker
            DB::table('background')->where('nama', $background->nama)->update(['nama' => $background->nama,  'image' => $createnewFileName, 'warna' => $background->warna, 'status' => $background->status]);
            // save file in databse

            Alert::info('Anda Berhasil Update Background');

            // Toast::success('Update Layout Status Berhasil');
            return redirect()->route('platform.table-background');
        }
    }
}
