<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Category;
use App\Models\InputAspiration;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', User::query()->where('role', 'siswa')->count())
                ->icon('heroicon-o-users')
                ->color('success'),
            Stat::make('Total Kategori', Category::query()->count())
                ->icon('heroicon-o-tag')
                ->color('warning'),
            Stat::make('Total Aspirasi', InputAspiration::query()->count())
                ->icon('heroicon-o-chat-bubble-left-right')
                ->color('info'),
        ];
    }
}
