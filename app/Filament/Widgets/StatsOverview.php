<?php

namespace App\Filament\Widgets;

use App\Models\Cow;
use App\Models\MilkAmount;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Calves',
                Cow::where('birthday_date', '>', Carbon::now()->subYear())->count()),
            Stat::make('Abnormal Cows',
                Cow::where('cow_status','0')->count()),
            Stat::make('Pregnant Cows',
                Cow::where('is_pregnant','1')->count()),
            Stat::make('Total milk amount morning',
                MilkAmount::sum('morning_amount')),
            Stat::make('Total milk amount morning',
                MilkAmount::sum('afternoon_amount')),
        ];
    }
}