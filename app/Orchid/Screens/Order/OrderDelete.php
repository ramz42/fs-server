<?php

namespace App\Orchid\Screens\Order;

use App\Models\Settings_menu;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;

class OrderDelete extends Screen
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
        return 'Delete Order';
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
            Input::make(name: 'menu_title')
                ->type('text')
                ->title('Masukkan Judul Menu Order'),



            Button::make('Delete')
                ->method('destroy'),
            ]),
        ];
    }

    public function destroy(Request $request)
    {
        // ...
        $res = Settings_menu::where('menu_title', $request->menu_title)->delete();
        
        Toast::success('Delete Order Menu Sukses');

        return back();
    }
}
