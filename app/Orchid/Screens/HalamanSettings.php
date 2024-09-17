<?php

namespace App\Orchid\Screens;

use App\View\Components\HalamanSettings as ComponentsHalamanSettings;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;

// 

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;

use function PHPSTORM_META\type;

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
        return [];
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
