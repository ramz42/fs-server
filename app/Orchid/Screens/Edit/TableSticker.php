<?php

namespace App\Orchid\Screens\Edit;

use App\Models\Background;
use App\Models\Layout as ModelsLayout;
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
use Orchid\Screen\TD;

class TableSticker extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        $sticker = Sticker_model::latest()->paginate(perPage: 20);
        return [
            'sticker' => $sticker
        ];
    }


    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Sticker Table';
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
            Layout::table('sticker', [
                TD::make('nama')->align(TD::ALIGN_CENTER)->render(function ($sticker) {
                    return substr($sticker->nama, 0, 30);
                }),

                TD::make('gambar')->align(TD::ALIGN_CENTER)->render(function ($sticker) {
                    return "<center><img src='http://127.0.0.1:8000/storage/sticker/{$sticker->nama_img}' width='150' height='150' style='margin: 0 auto; object-fit: contain;'></center>";
                }),

                TD::make('status')->align(TD::ALIGN_CENTER)->render(function ($sticker) {
                    return substr($sticker->status, 0, 30);
                }),

                TD::make('update')->align(TD::ALIGN_CENTER)->render(
                    fn($sticker) =>  Link::make('Update')
                        ->icon('pencil')->route('platform.update-sticker', [$sticker]),
                ),
            ]),


        ];
    }
}
