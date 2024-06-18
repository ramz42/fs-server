<?php

use App\Http\Controllers\Api\EditPhotoController;
use App\Http\Controllers\Api\SesiFotoController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\MenuPhoto;
use App\Http\Controllers\User_foto;
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

Route::get(
    '/users',
    [UsersController::class, 'index']
)->name('get-user');


Route::get(
    '/sesi',
    [SesiFotoController::class, 'index']
)->name('get-sesi');


Route::get(
    '/edit',
    [EditPhotoController::class, 'index']
)->name('get-edit');

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

// post edit foto
Route::post(
    '/edit',
    [EditPhotoController::class, 'store']
)->name('post-edit');

// post sesi foto
Route::post(
    '/sesi',
    [SesiFotoController::class, 'store']
)->name('post-sesi');

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

Route::delete(
    '/users/{id}',
    [UsersController::class, 'destroy']
)->name('delete-user');


// upload image
Route::post('upload-image', [UploadController::class, 'imageUpload']);

// update image
Route::post('update-image/{nama}', [ImageController::class, 'update']);

// delete image
Route::post('delete-image', [ImageController::class, 'delete']);

// show image
Route::post('/show-image/{id}', [ImageController::class, 'show']);

// upload image file tester 
Route::post('upload-server', [UploadController::class, 'uploadToServer'])->name('upload-to-server');

// upload image print edit
Route::post('upload-print', [UploadController::class, 'imageUploadPrint']);

// upload image-background-/ background menu card
Route::post('settings', [UploadController::class, 'settings']);

// upload image-background-/ background menu card
Route::post('menu-update', [MenuPhoto::class, 'update']);

// upload image-background-/ background menu card
Route::post('menu-buat', [MenuPhoto::class, 'store']);

// delete menu settings
Route::delete(
    '/menu-delete/{id}',
    [MenuPhoto::class, 'destroy']
);
