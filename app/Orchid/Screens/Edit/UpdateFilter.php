<?php

namespace App\Orchid\Screens\Edit;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;


use App\Models\Filter as ModelsFilter;

class UpdateFilter extends Screen
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
        return 'Update Filter';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make("Buat Filter")->icon('plus')->route('platform.buat-filter'),
            Link::make("Update Filter")->icon('pencil')->route('platform.update-filter'),
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

                Input::make('nama')
                    ->type('text')
                    ->title('Nama Filter'),

                Input::make('status')
                    ->type('text')
                    ->title('Status Filter'),

                Input::make('warna')->type('color')
                    ->title('Warna Filter'),


                Button::make('Simpan')
                    ->method('update'),
            ]),
        ];
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        // ...
        $filter = new ModelsFilter();
        $filter->nama = $request->nama;
        $filter->status = $request->status;
        $filter->warna = $request->warna;

        DB::table('filter')
            ->where('nama', $filter->nama)
            ->update(['nama' => $filter->nama, 'status' => $filter->status, 'warna' => $filter->warna]);

        Toast::success('Update Filter Baru Berhasil');
        return back();
    }
}
