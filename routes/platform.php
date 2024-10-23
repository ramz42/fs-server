<?php

declare(strict_types=1);

use App\Orchid\Screens\Edit\BuatLayout;
use App\Orchid\Screens\Edit\KostumLayout;
use App\Orchid\Screens\Edit\TableBackground;
use App\Orchid\Screens\Edit\TableLayout;
use App\Orchid\Screens\Edit\TableSticker;
use App\Orchid\Screens\Edit\UpdateBackground;
use App\Orchid\Screens\Edit\UpdateFilter;
use App\Orchid\Screens\Edit\UpdateLayout;
use App\Orchid\Screens\Edit\UpdateSticker;
use App\Orchid\Screens\Order\MenuOrder;
use App\Orchid\Screens\Order\OrderBuat;
use App\Orchid\Screens\Order\OrderDelete;
use App\Orchid\Screens\Order\OrderUpdate;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\Settings\BuatBackground;
use App\Orchid\Screens\Settings\BuatFilter;
use App\Orchid\Screens\Settings\BuatSticker;
use App\Orchid\Screens\Settings\HalamanSettings;
use App\Orchid\Screens\Settings\LaporanInvoices;
use App\Orchid\Screens\Settings\WarnaHalaman;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// use App\Orchid\Screens\Settings\LaporanInvoices;
// use App\Orchid\Screens\Settings\HalamanSettings;
// use App\Orchid\Screens\Settings\WarnaHalaman;
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn(Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn(Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));


// Route::screen('idea', Idea::class, 'platform.screens.idea');
Route::screen('/halaman-settings', HalamanSettings::class)->name('platform.halaman-settings');
Route::screen('/halaman-order', \App\Orchid\Screens\Order\HalamanOrder::class)->name('platform.halaman-order');
Route::screen('/halaman-edit', \App\Orchid\Screens\Order\HalamanOrder::class)->name('platform.halaman-edit');

Route::screen('/warna-halaman', WarnaHalaman::class)->name('platform.warna-halaman');
Route::screen('/menu-order', MenuOrder::class)->name('platform.menu-order');
Route::screen('/laporan-invoices', LaporanInvoices::class)->name('platform.laporan-invoices');
Route::screen('/beranda', \App\Orchid\Screens\Beranda::class)->name('platform.beranda');

// screen menu order
Route::screen('order-buat', OrderBuat::class)->name('platform.order-buat');
Route::screen('order-update', OrderUpdate::class)->name('platform.order-update');
Route::screen('order-delete', OrderDelete::class)->name('platform.order-delete');

Route::screen('layout', TableLayout::class)->name('platform.layout');
Route::screen('buat-layout', BuatLayout::class)->name('platform.buat-layout');
Route::screen('kostum-layout/{parameter?}', KostumLayout::class)->name('platform.kostum-layout');
Route::screen('update-layout/{layout?}', UpdateLayout::class)->name('platform.update-layout');

Route::screen('buat-filter', BuatFilter::class)->name('platform.buat-filter');
Route::screen('update-filter', UpdateFilter::class)->name('platform.update-filter');

Route::screen('sticker', TableSticker::class)->name('platform.sticker');
Route::screen('buat-sticker', BuatSticker::class)->name('platform.buat-sticker');
Route::screen('update-sticker/{sticker?}', UpdateSticker::class)->name('platform.update-sticker');

Route::screen('background', TableBackground::class)->name('platform.background');
Route::screen('buat-background', BuatBackground::class)->name('platform.buat-background');
Route::screen('update-background/{parameter?}', UpdateBackground::class)->name('platform.update-background');
