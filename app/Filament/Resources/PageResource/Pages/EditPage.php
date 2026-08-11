<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use IbrahimBougaoua\Filawidget\Resources\PageResource\Pages\EditPage as BaseEditPage;

class EditPage extends BaseEditPage
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
