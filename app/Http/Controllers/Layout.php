<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Layout as ModelsLayout;
use App\Models\Layout_Custome;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Layout extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return ModelsLayout::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // ...
        // $id = $request->id;
        // $layout =  Layout_Custome;
        // $layout->nama = $request->nama;
        // $layout->warna = $request->warna;
        // $layout->status = $request->status;


        // if ($layout->save()) {
        //     // update settings db

        //     $layout->save();
        //     $layout->insertOrIgnore($request->all());

        //     return response()->json($layout);
        // } else {
        //     return ['status' => false, 'message' => "Error : Image not uploded successfully"];
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Layout $layout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layout $layout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, String $nama)
    // {
    //     // ...
    //     $layout = new ModelsLayout();
    //     $layout->status = $request->status;

    //     DB::table('layout')
    //         ->where('nama', $nama)
    //         ->update(['status' => $request->status]);
    //     return response()->json($request, 201);
    // }
    public function update(Request $request, string $id)
    {
        // ...
        $id = $request->id;
        $layout =  ModelsLayout::find($id);
        $layout->nama = $request->nama;
        $layout->warna = $request->warna;
        $layout->status = $request->status;


        if ($layout->save()) {
            // update settings db

            $layout->save();
            $layout->insertOrIgnore($request->all());

            return response()->json($layout);
        } else {
            return ['status' => false, 'message' => "Error : Image not uploded successfully"];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layout $layout)
    {
        //
    }
}
