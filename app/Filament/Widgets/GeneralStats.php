<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Category;

class GeneralStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total User', User::count()),
            Stat::make('Total Category', Category::whereNull('parent_id')->count()),
            Stat::make('Total Sub-Category', Category::whereNotNull('parent_id')->count()),
            Stat::make('Total Product', Product::count()),
        ];
    }
}
