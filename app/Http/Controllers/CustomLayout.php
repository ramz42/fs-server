<?php

namespace App\Http\Controllers;

use App\Models\LayoutCustome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CustomLayout extends Controller
{
    //

    public function index()
    {
        return LayoutCustome::all();
    }

    public function generate(Request $request)
    {
        // ...
        $layout = new LayoutCustome();
        $layout->nama = $request->nama;
        $layout->panjang = $request->panjang;
        $layout->lebar = $request->lebar;

        $cookie_nama = Cookie::queue('nama', $request->nama, 50);
        $cookie_panjang = Cookie::queue('panjang', $request->panjang, 120);
        $cookie_lebar = Cookie::queue('lebar', $request->lebar, 120);

        // update settings db
        DB::table('custome_layout')->insert(['nama' => $layout->nama, 'panjang' => $layout->panjang, 'lebar' => $layout->lebar]);

        $this->validate($request, [
            'nama' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
        ]);

        return view('custom-layout.custom-layout-generate', ['data' => $request, 'type' => 1]);
    }

    public function generate_box(Request $request)
    {
        // ...
        $layout = new LayoutCustome();
        $layout->kotak1_top = $request->top;
        $layout->kotak1_left = $request->left;
        $layout->kotak1_width = $request->width;
        $layout->kotak1_height = $request->height;

        $value = $request->cookie('cookie_nama');

        $nama = $request->cookie('nama');
        $panjang = $request->cookie('panjang');
        $lebar = $request->cookie('lebar');

        $top1 = null;
        $left1 = null;
        $height1 = null;
        $width1 = null;
        $kategori1 = null;

        $top2 = null;
        $left2 = null;
        $height2 = null;
        $width2 = null;
        $kategori2 = null;

        $this->validate($request, [
            'top' => 'required',
            'left' => 'required',
            'width' => 'required',
            'height' => 'required',
        ]);

        switch ($request->input('action')) {
            case 'generate':
                // generate
                return view('custom-layout.custom-layout-generate-box', ['data' => $request, 'top1' => $top1, 'left1' => $left1, 'height1' => $height1, 'width1' => $width1, 'kategori1' => $kategori1, 'nama' => $nama, 'panjang' => $panjang, 'lebar' => $lebar, 'type' => 1]);

            case 'generate2':
                // generate
                return view('custom-layout.custom-layout-generate-box', ['data' => $request, 'top1' => $request->cookie('top1'), 'left1' => $request->cookie('left1'), 'height1' => $request->cookie('height1'), 'width1' => $request->cookie('width1'), 'kategori1' => $request->cookie('kategori1'), 'nama' => $nama, 'panjang' => $panjang, 'lebar' => $lebar, 'type' => 2]);


            case 'simpan':

                // =======
                // kotak 1 
                // =======
                $query = DB::table('custome_layout')
                    ->where('nama', $request->cookie('nama'))
                    ->update(['kotak1' => $request->kategori, 'kotak1_top' => $request->top, 'kotak1_left' => $request->left, 'kotak1_width' => $request->width, 'kotak1_height' => $request->height]);

                if ($query > 0) {
                    # code...
                    $top1 = Cookie::queue('top1', $request->top, 50);
                    $left1 = Cookie::queue('left1', $request->left, 50);
                    $height1 = Cookie::queue('height1', $request->height, 50);
                    $width1 = Cookie::queue('width1', $request->width, 50);
                    $kategori1 = Cookie::queue('kategori1', $request->kategori, 50);

                    // return dd($request->top);
                    return view('custom-layout.custom-layout-generate-box', ['data' => $request, 'top1' => $top1, 'left1' => $left1, 'height1' => $height1, 'width1' => $width1, 'kategori1' => $kategori1, 'nama' => $nama, 'panjang' => $panjang, 'lebar' => $lebar, 'type' => 2]);
                }

                // =======
                // kotak 2 
                // =======
                $query2 = DB::table('custome_layout')
                    ->where('nama', $request->cookie('nama'))
                    ->update(['kotak2_top' => $request->top, 'kotak2_left' => $request->left, 'kotak2_width' => $request->width, 'kotak2_height' => $request->height]);

                if ($query2) {
                    # code...
                    return view('custom-layout.custom-layout-generate-box', ['data' => $request, 'nama' => $nama, 'panjang' => $panjang, 'lebar' => $lebar, 'type' => 2]);
                }

                // =======
                // kotak 3 
                // =======
                $query3 = DB::table('custome_layout')
                    ->where('nama', $request->cookie('nama'))
                    ->update(['kotak3_top' => $request->top, 'kotak3_left' => $request->left, 'kotak3_width' => $request->width, 'kotak3_height' => $request->height]);

                if ($query3) {
                    # code...
                    return view('custom-layout.custom-layout-generate-box', ['data' => $request, 'nama' => $nama, 'panjang' => $panjang, 'lebar' => $lebar, 'type' => 3]);
                }
        }
    }
}
