<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Beranda')
                ->icon('bs.house')
                ->title('Beranda')
                ->route(config('platform.index'))
                ->divider(),

            Menu::make('Halaman Settings')
                ->icon('bs.collection')
                ->title(title: 'Menu Settings')
                ->route('platform.halaman-settings'),

            Menu::make('Halaman Order')
                ->icon('bs.collection')
                ->route('platform.halaman-order'),

            Menu::make('Tema Warna')
                ->icon('bs.collection')
                ->route('platform.warna-halaman'),

            Menu::make('Menu Order')
                ->icon('bs.collection')
                ->route('platform.order-buat'),

            Menu::make('Laporan Invoices')
                ->icon('bs.collection')
                ->route('platform.laporan-invoices')
                ->divider(),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Akses Kontrol')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

            Menu::make('Dokumentasi')
                ->title('Dokumentasi')
                ->icon('bs.box-arrow-up-right')
                ->url('https://orchid.software/en/docs')
                ->target('_blank'),

            Menu::make('Changelog')
                ->icon('bs.box-arrow-up-right')
                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(fn() => Dashboard::version(), Color::DARK),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
