<?php

declare(strict_types=1);

use App\Orchid\Screens\Beranda;
use App\Orchid\Screens\BuatBackground;
use App\Orchid\Screens\BuatFilter;
use App\Orchid\Screens\BuatSticker;
use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;

use App\Orchid\Screens\HalamanOrder;
use App\Orchid\Screens\LaporanInvoices;
use App\Orchid\Screens\MenuOrder;
use App\Orchid\Screens\OrderBuat;
use App\Orchid\Screens\OrderDelete;
use App\Orchid\Screens\OrderUpdate;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\TableLayout;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\WarnaHalaman;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\HalamanSettings;
use App\Orchid\Screens\MenuFilter;
use App\Orchid\Screens\MenuSticker;
use App\Orchid\Screens\TableBackground;
use App\Orchid\Screens\TableSticker;
use App\Orchid\Screens\UpdateBackground;
use App\Orchid\Screens\UpdateFilter;
use App\Orchid\Screens\UpdateLayout;
use App\Orchid\Screens\UpdateSticker;

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

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

//Route::screen('idea', Idea::class, 'platform.screens.idea');
Route::screen('/halaman-settings', HalamanSettings::class)->name('platform.halaman-settings');
Route::screen('/halaman-order', HalamanOrder::class)->name('platform.halaman-order');
Route::screen('/halaman-edit', HalamanOrder::class)->name('platform.halaman-edit');

Route::screen('/warna-halaman', WarnaHalaman::class)->name('platform.warna-halaman');
Route::screen('/menu-order', MenuOrder::class)->name('platform.menu-order');
Route::screen('/laporan-invoices', LaporanInvoices::class)->name('platform.laporan-invoices');
Route::screen('/beranda', Beranda::class)->name('platform.beranda');

// screen menu order
Route::screen('order-buat', OrderBuat::class)->name('platform.order-buat');
Route::screen('order-update', OrderUpdate::class)->name('platform.order-update');
Route::screen('order-delete', OrderDelete::class)->name('platform.order-delete');


Route::screen('table-layout', TableLayout::class)->name('platform.table-layout');
Route::screen('update-layout/{layout?}', UpdateLayout::class)->name('platform.update-layout');

Route::screen('buat-filter', BuatFilter::class)->name('platform.buat-filter');
Route::screen('update-filter', UpdateFilter::class)->name('platform.update-filter');

Route::screen('table-sticker', TableSticker::class)->name('platform.table-sticker');
Route::screen('buat-sticker', BuatSticker::class)->name('platform.buat-sticker');
Route::screen('update-sticker/{sticker?}', UpdateSticker::class)->name('platform.update-sticker');

Route::screen('table-background', TableBackground::class)->name('platform.table-background');
Route::screen('buat-background', BuatBackground::class)->name('platform.buat-background');
Route::screen('update-background/{layout?}', UpdateBackground::class)->name('platform.update-background');
