<?php

namespace App\Orchid\Screens\Settings;

use App\Models\Background;
use App\Models\Invoice;
use App\Models\Sticker_model;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Orchid\Support\Facades\Toast;
use App\Models\Filter as ModelsFilter;

use Orchid\Screen\Screen;



// Buat Filter
class BuatFilter extends Screen
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
        return 'Buat Filter';
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
                    ->method('store'),
            ]),
        ];
    }

    // ...
    public function store(Request $request)
    {
        // ...
        $filter = new ModelsFilter();
        $filter->nama = $request->nama;
        $filter->status = $request->status;
        $filter->warna = $request->warna;


        // insert sticker
        DB::table('filter')->insertOrIgnore(['nama' => $filter->nama,  'status' => $filter->status, 'warna' => $filter->warna]);
        // save file in databse
        Toast::success('Buat Filter Baru Berhasil');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // get all stickers
        return ModelsFilter::all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ...
        $id = $request->id;
        $filter =  ModelsFilter::find($id);
        $filter->nama = $request->nama;
        $filter->status = $request->status;
        $filter->warna = $request->warna;

        $filter->save();
        $filter->update($request->all());

        return response()->json($filter);
    }
}
