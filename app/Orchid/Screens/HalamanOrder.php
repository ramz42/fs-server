<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;

class HalamanOrder extends Screen
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
        return 'Background Image';
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

                Input::make('header_image')->type('file')
                    ->title('Header Image'),
                Input::make('background_image')->type('file')
                    ->title('Background Image'),

                Button::make('Simpan')
                    ->method('order'),
            ]),
        ];
    }

    // ...
    public function order(Request $req)
    {

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
            $getfileExtension = $req->file('header_image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time() . '-' . 'header' . '.' . $getfileExtension; // create new random file name
            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);

            $getfileExtension2 = $req->file('background_image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName2 = time() . '-' . 'background' . '.' . $getfileExtension2; // create new random file name
            $newPhotoFullPath2 = $newPath2 . $createnewFileName2;
            $resize2->save($newPhotoFullPath2);


            // update settings db
            DB::table('halaman_order')
                ->where('title', "order")
                ->update(['title' => "order", 'header_image' => $createnewFileName, 'background_image' => $createnewFileName2]);
            // save file in databse

            Toast::success('Update Halaman Order Sukses');
            return back();
        }
    }
}
