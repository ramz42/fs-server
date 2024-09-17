<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MalasngodingController extends Controller
{
    public function input()
    {
        return view('input');
    }

    public function proses(Request $request)
    {


        $nama = $request->nama;
        $pekerjaan = $request->pekerjaan;
        $usia = $request->usia;

        $this->validate($request, [
            'nama' => 'required|min:5|max:20',
            'pekerjaan' => 'required',
            'usia' => 'required|numeric'
        ]);

        DB::table('test_input')->insertOrIgnore([
            ['nama' => $nama, 'pekerjaan' => $pekerjaan, 'usia' => $usia],
        ]);

        return view('proses', ['data' => $request])->with('successMsg','Berhasil Insert Data Test Input');

        // return "proses";
    }
}
