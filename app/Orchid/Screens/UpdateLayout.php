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
use Orchid\Support\Facades\Alert;


use App\Models\Filter as ModelsFilter;
use App\Models\Layout as ModelsLayout;

class UpdateLayout extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(ModelsLayout $layout): iterable
    {

        return [
            'layout' => $layout
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Update Layout';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make("Layout Table")->icon('layer')->route('platform.table-layout'),
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

                Input::make('layout.nama')
                    ->type('text')
                    ->title('Nama Layout')->placeholder('Nama Layout'),

                Input::make('layout.status')
                    ->type('text')
                    ->title('Status Layout')->placeholder('Status Layout'),

                Button::make('Simpan')
                    ->method('update'),
            ]),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModelsLayout $layout, Request $request)
    {
        // ...
        $layout->fill($request->get('layout'))->save();

        Alert::info('Anda Berhasil Update Layout Status');

        // Toast::success('Update Layout Status Berhasil');
        return redirect()->route('platform.table-layout');
    }
}
