<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use IbrahimBougaoua\Filawidget\Models\Page;
use IbrahimBougaoua\Filawidget\Resources\PageResource as BasePageResource;

class PageResource extends BasePageResource
{
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->label(__('filawidget::filawidget.Title'))
                            ->required()
                            ->maxLength(255),
                        Select::make('parent_id')
                            ->label(__('filawidget::filawidget.Root'))
                            ->options(
                                Page::pluck('title', 'id')
                                    ->toArray()
                            )
                            ->default(
                                request()->has('page_id') ? request()->query('page_id') : null
                            )
                            ->searchable(),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->disabled()
                            ->helperText('/{slug} (ID) · /en/{slug} (EN)')
                            ->columnSpanFull(),
                        RichEditor::make('content')
                            ->label(__('filawidget::filawidget.Content'))
                            ->columnSpanFull(),
                        Toggle::make('status')
                            ->label(__('filawidget::filawidget.Status'))
                            ->inline(false)
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
