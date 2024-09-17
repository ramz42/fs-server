<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TableInvoice extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'invoices';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            
            TD::make('tanggal'),
            TD::make('no_invoice'),
            TD::make('code'),
            TD::make('paket'),
            TD::make('customer'),
            TD::make('email'),
            TD::make('no_telp'),
            TD::make('harga'),
            TD::make('aksi'),
            TD::make('created_at')->sort(),
        ];
    }
}
