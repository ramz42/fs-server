<?php

use App\Http\Controllers\Api\EditPhotoController;
use App\Http\Controllers\Api\SesiFotoController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Layout;
use App\Http\Controllers\MainColor;
use App\Http\Controllers\MenuPhoto;
use App\Http\Controllers\Order;
use App\Http\Controllers\SerialKeyController;
use App\Http\Controllers\Sticker;
use App\Http\Controllers\User_foto;
use App\Models\Serial_key;
use App\Models\Sticker as ModelsSticker;
use App\Models\Sticker_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// get users
Route::get(
    '/users',
    [UsersController::class, 'index']
)->name('get-user');

// get sesi
Route::get(
    '/sesi',
    [SesiFotoController::class, 'index']
)->name('get-sesi');

// get edit
Route::get(
    '/edit',
    [EditPhotoController::class, 'index']
)->name('get-edit');

// get background
Route::get(
    '/background',
    [EditPhotoController::class, 'index_background']
)->name('get-background');

// get serial key
Route::get(
    '/serial-key',
    [SerialKeyController::class, 'index']
)->name('get-serial-key');

// get background
Route::get(
    '/main-color',
    [MainColor::class, 'index']
)->name('get-warna');

Route::get(
    '/order-get',
    [Order::class, 'index']
)->name('get-order');

// post get image
Route::post(
    '/show-images',
    [ImageController::class, 'index']
)->name('show-images-index');

// post get image
Route::post(
    '/images-name-date',
    [ImageController::class, 'images']
)->name('show-images');

// post get image
Route::post(
    '/show-images-edit',
    [ImageController::class, 'images_edit']
)->name('show-images-edit');

// post user foto
Route::post(
    '/users',
    [UsersController::class, 'create']
)->name('user-post');

// create invoice
Route::post(
    '/invoices',
    [InvoiceController::class, 'create']
)->name('invoice-post');

Route::get(
    '/invoices',
    [InvoiceController::class, 'index']
)->name('get-invoice');

// update invoice
Route::post(
    '/invoices/{id}',
    [InvoiceController::class, 'update']
)->name('update-invoices');

// post edit foto
Route::post(
    '/edit',
    [EditPhotoController::class, 'store']
)->name('post-edit');

// post bg foto
Route::post(
    '/add-background',
    [EditPhotoController::class, 'storeBg']
)->name('post-bg');

// update bg with id
Route::put(
    '/background/{id}',
    [EditPhotoController::class, 'updateBg']
)->name('update-bg');

// post main color
Route::post(
    '/store-main-color',
    [EditPhotoController::class, 'storeMainColor']
)->name('store-main-color');

// post sesi foto
Route::post(
    '/sesi',
    [SesiFotoController::class, 'store']
)->name('post-sesi');

// create sticker
Route::post(
    '/add-sticker',
    [Sticker::class, 'store']
)->name('add-sticker');

// get sticker
Route::get(
    '/get-sticker',
    [Sticker::class, 'show']
)->name('get-sticker');

// update sticker
Route::post(
    '/update-sticker',
    [Sticker::class, 'update']
)->name('create-sticker');

// update user with id
Route::put(
    '/users/{id}',
    [UsersController::class, 'update']
)->name('update-user');

// update edit
Route::put(
    '/edit/{id}',
    [EditPhotoController::class, 'update']
)->name('update-edit');

// update sesi
Route::put(
    '/sesi/{id}',
    [SesiFotoController::class, 'update']
)->name('update-sesi-id');

// delete user
Route::delete(
    '/users/{id}',
    [UsersController::class, 'destroy']
)->name('delete-user');


// upload image edit
Route::post('upload-image-edit', [UploadController::class, 'editImage']);

// upload image
Route::post('upload-image', [UploadController::class, 'imageUpload']);

// update image
Route::post('update-image/{nama}', [ImageController::class, 'update']);

// delete image
Route::post('delete-image', [ImageController::class, 'delete']);

// delete folder
Route::post('delete-folder', [ImageController::class, 'deleteFolder']);

// delete folder images edit
Route::post('delete-folder-edit', [ImageController::class, 'deleteFolderImagesEdit']);

// show image
Route::post('/show-image/{id}', [ImageController::class, 'show']);

// upload image file tester 
Route::post('upload-server', [UploadController::class, 'uploadToServer'])->name('upload-to-server');

// upload image print edit
Route::post('upload-print', [UploadController::class, 'imageUploadPrint']);

// update settings
Route::post('settings', [UploadController::class, 'settings'])->name('settings');

// update order
Route::post('order', [UploadController::class, 'order']);

// upload image-background-/ background menu card
Route::post('menu-update', [MenuPhoto::class, 'update']);

// upload image-background-/ background menu card
Route::post('menu-buat', [MenuPhoto::class, 'store']);

// Get Layout
Route::get('layout', [Layout::class, 'index']);

// Post-Update Layout
Route::put('/layout/{nama}', [Layout::class, 'update']);

// delete menu settings
Route::delete(
    '/menu-delete/{id}',
    [MenuPhoto::class, 'destroy']
);
