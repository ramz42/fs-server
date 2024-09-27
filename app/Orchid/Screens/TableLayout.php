<?php

namespace App\Orchid\Screens;

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

class TableLayout extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        $layout = ModelsLayout::latest()->paginate(perPage: 20);
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
        return 'Layout Table';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
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
            Layout::table('layout', [
                TD::make('nama')->align(TD::ALIGN_CENTER)->render(function ($layout) {
                    return substr($layout->nama, 0, 30);
                }),

                TD::make('gambar')->align(TD::ALIGN_CENTER)->render(function ($layout) {
                    return "<center><img src='http://127.0.0.1:8000/storage/layout/{$layout->image}' width='150' height='150'></center>";
                }),

                TD::make('status')->align(TD::ALIGN_CENTER)->render(function ($layout) {
                    return substr($layout->status, 0, 30);
                }),
                
                TD::make('jumlah kotak')->align(TD::ALIGN_CENTER)->render(function ($layout) {
                    return substr($layout->jumlah_kotak, 0, 30);
                }),

                TD::make('edit status')->align(TD::ALIGN_CENTER)->render(
                    fn($layout) =>  Link::make('Edit Status')
                        ->icon('pencil')->route('platform.update-layout',[$layout]),
                ),
            ]),

            // modal demo
            Layout::modal('exampleModal', [
                Layout::rows([]),
            ]),

        ];
    }

    public function routing()
    {
        Link::make('Idea')
            ->route('platform.main');
    }

    public function update(Request $request)
    {
        // ...
        $layout = new ModelsLayout();
        $layout->nama = $request->nama;
        $layout->status = $request->status;
        $layout->warna = $request->warna;

        DB::table('layout')
            ->where('nama', $layout->nama)
            ->update(['nama' => $layout->nama, 'status' => $layout->status, 'warna' => $layout->warna]);

        Toast::success('Update Filter Baru Berhasil');
        return back();
    }
}
