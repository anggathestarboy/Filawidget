<?php

namespace App\Filament\Resources\WidgetResource\Pages;

use App\Filament\Resources\WidgetResource;
use App\Filament\Resources\WidgetResource\Concerns\SavesWidgetValues;
use IbrahimBougaoua\Filawidget\Resources\WidgetResource\Pages\CreateWidget as BaseCreateWidget;

class CreateWidget extends BaseCreateWidget
{
    use SavesWidgetValues;

    protected static string $resource = WidgetResource::class;

    protected function afterCreate(): void
    {
        $this->saveWidgetValues();
    }
}
