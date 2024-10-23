<?php

namespace App\Orchid\Screens\Edit;

use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;

use App\Models\Layout as ModelsLayout;
use App\Models\LayoutCustome;

class UpdateLayout extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(LayoutCustome $layout): iterable
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
            Link::make("Layout Table")->icon('layer')->route('platform.layout'),
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

                Select::make('layout.status')
                    ->options([
                        'Aktif'   => 'Aktif',
                        'Tidak Aktif' => 'Tidak Aktif',
                    ])
                    ->title('Pilih Status')
                    ->help('Status Layout'),

                
                // Input::make('layout.status')
                //     ->type('text')
                //     ->title('Status Layout')->placeholder('Status Layout'),

                Button::make('Simpan')
                    ->method('update'),
            ]),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LayoutCustome $layout, Request $request)
    {
        // ...
        $layout->fill($request->get('layout'))->save();
        Alert::info('Anda Berhasil Update Status Layout');

        // Toast::success('Update Layout Status Berhasil');
        return redirect()->route('platform.layout');
    }
}
