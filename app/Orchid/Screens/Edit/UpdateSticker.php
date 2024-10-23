<?php

namespace App\Orchid\Screens\Edit;

use App\Models\Sticker_model;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;

class UpdateSticker extends Screen
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
        return 'Update Sticker';
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
                    ->method('update'),
            ]),
        ];
    }

    // ...
    public function update(Request $request)
    {
        // ...
        $sticker = new Sticker_model();
        $sticker->nama = $request->nama_sticker;
        $sticker->status = $request->status;

        // $fileName = $request->get('gambar_sticker') . '.png';

        if (!is_dir(storage_path("app/public/sticker/"))) {
            mkdir(storage_path("app/public/sticker/"), 0755, true);
        }

        $newPath = storage_path("app/public/sticker/");
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }

        $resize = Image::make($request->file('gambar_sticker'))->encode('jpg');

        if ($request->hasFile('gambar_sticker')) {
            $filename = $request->file('gambar_sticker')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $request->file('gambar_sticker')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '-' . 'sticker' . '.' . $getfileExtension; // create new random file name
            $sticker->nama_img = $createnewFileName; // pass file name with column
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);


            DB::table('sticker')
                ->where('nama', $sticker->nama)
                ->update(['nama' => $sticker->nama, 'status' => $sticker->status, 'nama_img' => $createnewFileName]);

            Toast::success('Update Sticker Berhasil');
            return back();
        }
    }
}
