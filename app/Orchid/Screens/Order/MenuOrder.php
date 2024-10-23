<?php

namespace App\Orchid\Screens\Order;

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
        ];
    }
}
