<?php

namespace App\Http\Controllers;

use App\Models\Filter as ModelsFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class Filter extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
        return ['status' => true, 'message' => "Filter store successfully"];
    }

    /**
     * Display the specified resource.
     */
    public function show(Sticker $sticker)
    {
        // get all filter
        return ModelsFilter::all();
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
        return response()->json($request, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filter $filter)
    {
        //
    }
}
