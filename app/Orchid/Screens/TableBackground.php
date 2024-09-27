<?php

namespace App\Orchid\Screens;

use App\Models\Background;
use App\Models\Layout as ModelsLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\TD;

class TableBackground extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        $background = Background::latest()->paginate(perPage: 20);
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
        return 'Background Table';
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
            // Layout::view('laporan_invoices'),
            Layout::table('background', [
                TD::make('nama')->align(TD::ALIGN_CENTER)->render(function ($background) {
                    return substr($background->nama, 0, 30);
                }),

                TD::make('gambar')->align(TD::ALIGN_CENTER)->render(function ($background) {
                    return "<center><img src='http://127.0.0.1:8000/storage/background/{$background->image}' width='150' height='150'></center>";
                }),

                TD::make('warna')->align(TD::ALIGN_CENTER)->render(function ($background) {
                    return substr($background->warna, 0, 30);
                }),

                TD::make('status')->align(TD::ALIGN_CENTER)->render(function ($background) {
                    return substr($background->status, 0, 30);
                }),

                TD::make('update')->align(TD::ALIGN_CENTER)->render(
                    fn($background) =>  Link::make('Update')
                        ->icon('pencil')->route('platform.update-background', [$background]),
                ),
            ]),


        ];
    }
}
