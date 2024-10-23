<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrchidController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('greeting', ["name" => 'Layout', 'panjang' => 500, 'lebar' => 300]);
    }


    public function generate(Request $request)
    {
        // ...
        // $this->validate($request, [
        //     'panjang' => 'required',
        //     'lebar' => 'required',
        // ]);

        return view('layout_generate', ['data' => $request]);
    }

    public function input()
    {
        return view('greeting', ["name" => 'Layout', 'panjang' => 500, 'lebar' => 300]);
    }

    public function proses(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:5|max:20',
            'pekerjaan' => 'required',
            'usia' => 'required|numeric'
        ]);

        return view('proses', ['data' => $request]);
    }

    public function proses_layout(Request $request)
    {
        // $this->validate($request,[
        //    'nama' => 'required|min:5|max:20',
        //    'pekerjaan' => 'required',
        //    'usia' => 'required|numeric'
        // ]);

        return view('proses',);
    }
}
