<?php

namespace App\Orchid\Screens;

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
            ModalToggle::make('Launch demo modal')
                ->modal('exampleModal')
                ->method('action')
                ->icon('full-screen'),
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
            Layout::table('invoices', [
                TD::make('tanggal')->render(function ($invoices) {
                    return substr($invoices->tanggal, 0, 10);
                }),
                TD::make('no invoice')->render(function ($invoices) {
                    return substr($invoices->no_invoice, 0, 10);
                }),
                TD::make('code')->render(function ($invoices) {
                    return substr($invoices->code, 0, 10);
                }),
                TD::make('paket')->render(function ($invoices) {
                    return substr($invoices->paket, 0, 10);
                }),
                TD::make('customer')->render(function ($invoices) {
                    return substr($invoices->customer, 0, 10);
                }),
                TD::make('email')->render(function ($invoices) {
                    return substr($invoices->email, 0, 10);
                }),
                TD::make('no telp')->render(function ($invoices) {
                    return substr($invoices->no_telp, 0, 10);
                }),
                TD::make('harga')->render(function ($invoices) {
                    return substr($invoices->harga, 0, 10);
                }),
                TD::make('created at')->render(function ($invoices) {
                    return substr($invoices->created_at, 0, 10);
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
        Toast::info('Hello, world! This is a toast message.');
        // Layout::modal('exampleModals', [
        //     Layout::rows([]),
        // ])
        //     ->applyButton('Send')
        //     ->closeButton('Close');
    }
}
