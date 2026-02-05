<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Siswa\Auth\Login;
use App\Filament\Siswa\Resources\Aspirations\AspirationResource;

class SiswaPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('siswa')
            ->path('siswa')
            ->brandName('Siswa')
            ->login(Login::class)
            ->authGuard('web')
            ->revealablePasswords(true)
            ->loginRouteSlug('login')
            ->font('SN Pro')
            ->globalSearch(false)
            ->sidebarCollapsibleOnDesktop()
            ->icons([
                'panels::sidebar.collapse-button' => Heroicon::Bars3,
                'panels::sidebar.expand-button' => Heroicon::XCircle,
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->default(fn () => AspirationResource::getUrl('index'))
            ->discoverResources(in: app_path('Filament/Siswa/Resources'), for: 'App\Filament\Siswa\Resources')
            ->discoverPages(in: app_path('Filament/Siswa/Pages'), for: 'App\Filament\Siswa\Pages')
            ->pages([
                //
            ])
            ->discoverWidgets(in: app_path('Filament/Siswa/Widgets'), for: 'App\Filament\Siswa\Widgets')
            ->widgets([
                //
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
