<?php

namespace App\Filament\Plugins;

use App\Filament\Resources\WidgetResource;
use Filament\Panel;
use IbrahimBougaoua\Filawidget\Pages\Appearance;
use IbrahimBougaoua\Filawidget\Resources\PageResource;
use IbrahimBougaoua\Filawidget\Resources\WidgetAreaResource;
use IbrahimBougaoua\Filawidget\Resources\WidgetAreaResource\Widgets\WidgetAreaStatsOverview;
use IbrahimBougaoua\Filawidget\Resources\WidgetFieldResource;
use IbrahimBougaoua\Filawidget\Resources\WidgetResource\Widgets\WidgetStatsOverview;
use IbrahimBougaoua\Filawidget\Resources\WidgetTypeResource;

class FilaWidgetPlugin extends \IbrahimBougaoua\Filawidget\FilaWidgetPlugin
{
    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                PageResource::class,
                WidgetAreaResource::class,
                WidgetFieldResource::class,
                WidgetTypeResource::class,
                WidgetResource::class,
            ])
            ->pages([
                Appearance::class,
            ])
            ->widgets([
                WidgetStatsOverview::class,
                WidgetAreaStatsOverview::class,
            ]);
    }
}
