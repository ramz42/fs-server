<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Contracts\Cardable;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Card;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class MenuOrder extends Screen
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
        return 'Menu Order';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            
            Link::make("Buat Order")->icon('bs.collection')->route('platform.order-buat'),
            Link::make("Update Order")->icon('bs.collection')->route('platform.order-update'),
            Link::make("Delete Order")->icon('trash')->route('platform.order-delete')
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
            Layout::view('menu_order'),

            // Layout::rows([

            //     Input::make('pin')
            //         ->type('text')
            //         ->title('Pin'),

            //     Input::make('server_key')
            //         ->type('text')
            //         ->title('Server Key'),

            //     Input::make('judul')
            //         ->type('text')
            //         ->title('Judul'),

            //     Input::make('deskripsi')
            //         ->type('text')
            //         ->title('Deskripsi'),

            //     Input::make('string_logo')
            //         ->type('text')
            //         ->title('String Logo'),

            //     Input::make('image')->type('file'),


            //     Button::make('Simpan')
            //         ->method('simpanSettings'),

                // Layout::view('menu_order'),


            // ]),
        ];
    }
}
