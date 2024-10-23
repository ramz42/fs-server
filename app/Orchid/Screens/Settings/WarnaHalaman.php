<?php

namespace App\Orchid\Screens\Settings;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;

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
