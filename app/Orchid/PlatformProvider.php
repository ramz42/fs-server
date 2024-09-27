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

            Menu::make('Order - Settings')
                ->icon('grid')
                ->list([
                    Menu::make('Halaman Order')
                        ->icon('layers')
                        ->route('platform.halaman-order')->sort(1),

                    Menu::make('Halaman Settings')
                        ->icon('layers')
                        ->route('platform.halaman-settings')->sort(2),

                ])->divider(),


            Menu::make('Edit Photo')
                ->icon('pencil')
                ->list([
                    Menu::make('Layout')
                        ->icon('layers')
                        ->route('platform.table-layout'),

                    Menu::make('Background')
                        ->icon('layers')
                        ->route('platform.table-background'),

                    Menu::make('Filter')
                        ->icon('layers')
                        ->route('platform.buat-filter'),

                    Menu::make('Sticker')
                        ->icon('layers')
                        ->route('platform.table-sticker'),

                ])->divider(),


            Menu::make('Akses Kontrol')
                ->icon('bs.shield')
                ->list([
                    Menu::make(__('Users'))
                        ->icon('bs.people')
                        ->route('platform.systems.users')
                        ->permission('platform.systems.users')
                        ->title(__('Akses Kontrol')),

                    Menu::make(__('Roles'))
                        ->icon('bs.shield')
                        ->route('platform.systems.roles')
                        ->permission('platform.systems.roles')

                ])->divider(),

            Menu::make('Dokumentasi')
                ->icon('bs.box-arrow-up-right')
                ->list([
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

                ])->divider(),



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
