<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Invoice::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        //
        $invoices = new Invoice();
        $invoices->tanggal = $request->tanggal;
        $invoices->no_invoice = $request->no_invoice;
        $invoices->code = $request->code;
        $invoices->paket = $request->paket;
        $invoices->customer = $request->customer;
        $invoices->email = $request->email;
        $invoices->no_telp = $request->no_telp;
        $invoices->harga = $request->harga;
        $invoices->image = $request->image;

        // $fileName = $request->get('image') . '.png';

        // if (!is_dir(storage_path("app/public/uploads/invoice"))) {
        //     mkdir(storage_path("app/public/uploads/invoice"), 0755, true);
        // }

        // $newPath = storage_path('app/public/uploads/invoice/');
        // if (!file_exists($newPath)) {
        //     mkdir($newPath, 0755);
        // }
        // // background image no resize
        // $resize = Image::make($request->file('image'));


        // if ($request->hasFile('image')) {

        //     $filename = $request->file('image')->getClientOriginalName(); // get the file name
        //     $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
        //     $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
        //     $createnewFileName = $invoices->customer . '-' . $invoices->no_invoice . '.' .  $getfileExtension; // create new random file name

        //     $invoices->image = $createnewFileName; // pass file name with column

        //     $newPhotoFullPath = $newPath . $createnewFileName;
        //     $resize->save($newPhotoFullPath);
        // }

        // update settings db
        DB::table('invoices')->insert(['image' => '-', 'tanggal' => $invoices->tanggal, 'no_invoice' => $invoices->no_invoice, 'code' => $invoices->code, 'paket' => $invoices->paket, 'customer' => $invoices->customer, 'email' => $invoices->email, 'no_telp' => $invoices->no_telp, 'harga' => $invoices->harga]);
        return response()->json($invoices, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(request $request, $id)
    {
        //
        $invoices = new Invoice();
        // $invoices->tanggal = $request->tanggal;
        $invoices->no_invoice = $request->no_invoice;
        // $invoices->code = $request->code;
        // $invoices->paket = $request->paket;
        $invoices->customer = $request->customer;
        // $invoices->email = $request->email;
        // $invoices->no_telp = $request->no_telp;
        // $invoices->harga = $request->harga;
        $invoices->image = $request->image;

        $fileName = $request->get('image') . '.png';

        if (!is_dir(storage_path("app/public/uploads/invoice"))) {
            mkdir(storage_path("app/public/uploads/invoice"), 0755, true);
        }

        $newPath = storage_path('app/public/uploads/invoice/');
        if (!file_exists($newPath)) {
            mkdir($newPath, 0755);
        }
        // background image no resize
        $resize = Image::make($request->file('image'));


        if ($request->hasFile('image')) {

            $filename = $request->file('image')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $request->file('image')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = $invoices->customer . '-' . $invoices->no_invoice . '.' .  $getfileExtension; // create new random file name

            $invoices->image = $createnewFileName; // pass file name with column

            $newPhotoFullPath = $newPath . $createnewFileName;
            $resize->save($newPhotoFullPath);
        }

        // update invoice db
        DB::table('invoices')->where('id', $id)
            ->update(['image' => $invoices->image]);
        return response()->json($invoices, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
