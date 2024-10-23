<?php

use App\Http\Controllers\CustomLayout;
use App\Http\Controllers\HalamanSettings as ControllersHalamanSettings;
use App\Http\Controllers\MalasngodingController;
use App\Http\Controllers\OrchidController;
use App\Orchid\Screens\HalamanSettings;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});