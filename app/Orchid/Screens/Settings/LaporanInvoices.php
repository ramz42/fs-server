<?php

namespace App\Orchid\Screens\Settings;

use App\Models\Invoice;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class LaporanInvoices extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        $invoices = Invoice::latest()->paginate(10);
        return [
            'invoices' => $invoices
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Laporan Invoices';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make("Halaman Settings")->icon('gear')->route('platform.halaman-settings'),
            Link::make("Laporan Invoice")->icon('pencil')->route('platform.laporan-invoices'),
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
            Layout::table('invoices', [
                TD::make('tanggal')->render(function ($invoices) {
                    return substr($invoices->tanggal, 0, 30);
                }),
                TD::make('no invoice')->render(function ($invoices) {
                    return substr($invoices->no_invoice, 0, 40);
                }),
                TD::make('code')->render(function ($invoices) {
                    return substr($invoices->code, 0, 40);
                }),
                TD::make('paket')->render(function ($invoices) {
                    return substr($invoices->paket, 0, 30);
                }),
                TD::make('customer')->render(function ($invoices) {
                    return substr($invoices->customer, 0, 30);
                }),
                TD::make('email')->render(function ($invoices): string {
                    return substr($invoices->email, 0, 30);
                }),

                TD::make('no telp')->render(function ($invoices) {
                    return substr($invoices->no_telp, 0, 30);
                }),

                TD::make('harga')->render(function ($invoices) {
                    return substr($invoices->harga, 0, length: 30);
                }),

                TD::make('created at')->render(function ($invoices) {
                    return substr($invoices->created_at, 0, 30);
                }),

                TD::make('Aksi')->render(
                    fn() =>  Button::make('print')
                        ->icon('printer')
                        ->modal(
                            'exampleModal',
                        )->method('action'),
                ),
            ]),

            // modal demo
            Layout::modal('exampleModal', [
                Layout::rows([]),
            ]),

        ];
    }

    public function action(): void
    {
        Layout::modal('exampleModal', [
            Layout::rows([]),
        ]);
    }
}
