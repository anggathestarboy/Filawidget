<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WidgetResource\Pages;
use App\Support\Localization;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use IbrahimBougaoua\Filawidget\Models\Field as WidgetsField;
use IbrahimBougaoua\Filawidget\Models\Widget;
use IbrahimBougaoua\Filawidget\Models\WidgetArea;
use IbrahimBougaoua\Filawidget\Models\WidgetField;
use IbrahimBougaoua\Filawidget\Models\WidgetType;
use IbrahimBougaoua\Filawidget\Resources\WidgetResource as BaseWidgetResource;

class WidgetResource extends BaseWidgetResource
{
    protected static ?string $model = Widget::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWidgets::route('/'),
            'create' => Pages\CreateWidget::route('/create'),
            'edit' => Pages\EditWidget::route('/{record}/edit'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('filawidget::filawidget.Name'))
                            ->required()
                            ->columnSpanFull(),
                        Select::make('widget_area_id')
                            ->label(__('filawidget::filawidget.Area'))
                            ->options(
                                WidgetArea::pluck('name', 'id')->toArray()
                            )
                            ->required()
                            ->searchable()
                            ->default(
                                request()->has('area_id') ? request()->query('area_id') : null
                            ),
                        Select::make('widget_type_id')
                            ->label(__('filawidget::filawidget.Widget Type'))
                            ->searchable()
                            ->options(
                                WidgetType::pluck('name', 'id')->toArray()
                            )
                            ->afterStateUpdated(function (callable $set, $state) {
                                $widgetType = WidgetType::find($state);
                                if ($widgetType) {
                                    $set('fieldsIds', $widgetType->fieldsIds);
                                }
                            })
                            ->reactive()
                            ->required(),
                        Select::make('locale')
                            ->label(__('Language'))
                            ->options(Localization::locales())
                            ->default(Localization::defaultLocale())
                            ->afterStateHydrated(function (callable $set, $state) {
                                if (! array_key_exists($state, Localization::locales())) {
                                    $set('locale', Localization::defaultLocale());
                                }
                            })
                            ->reactive(),
                        RichEditor::make('description')
                            ->label(__('filawidget::filawidget.Description'))
                            ->columnSpanFull(),
                        Toggle::make('status')
                            ->label(__('filawidget::filawidget.Status')),
                        Hidden::make('fieldsIds')
                            ->reactive(),
                        Repeater::make('values')
                            ->label(__('filawidget::filawidget.Configurations'))
                            ->schema(function (callable $get) {
                                $fieldsIds = $get('fieldsIds') ?? [];

                                $widgetId = $get('id') ?? null;

                                $fields = [];
                                if (is_array($fieldsIds) && count($fieldsIds) > 0) {
                                    $fields = WidgetsField::whereIn('id', $fieldsIds)
                                        ->get(['fields.name', 'fields.type', 'fields.options', 'fields.id'])
                                        ->toArray();
                                }

                                $values = [];
                                if (! is_null($widgetId) && is_array($fieldsIds) && count($fieldsIds) > 0) {
                                    $values = WidgetField::where('widget_id', $widgetId)
                                        ->whereIn('widget_field_id', $fieldsIds)
                                        ->get(['widget_field_id', 'value'])
                                        ->pluck('value', 'widget_field_id')
                                        ->toArray();
                                }

                                $components = [];

                                foreach ($fields as $field) {
                                    $options = is_array($field['options'])
                                        ? $field['options']
                                        : (json_decode((string) $field['options'], true) ?: []);

                                    $defaultValue = $options['default'] ?? '';

                                    $stored = $values[$field['id']] ?? null;

                                    foreach (Localization::locales() as $locale => $label) {
                                        $fieldName = "{$field['name']}_{$locale}";

                                        $component = match ($field['type']) {
                                            'text' => TextInput::make($fieldName),
                                            'textarea' => Textarea::make($fieldName),
                                            'number' => TextInput::make($fieldName)->numeric(),
                                            'select' => Select::make($fieldName)->options($options),
                                            'checkbox' => Checkbox::make($fieldName),
                                            'radio' => Radio::make($fieldName)->options($options),
                                            'toggle' => Toggle::make($fieldName),
                                            'color' => ColorPicker::make($fieldName),
                                            'date' => DatePicker::make($fieldName),
                                            'datetime' => DateTimePicker::make($fieldName),
                                            'time' => TimePicker::make($fieldName),
                                            'file' => FileUpload::make($fieldName),
                                            'image' => FileUpload::make($fieldName)->image(),
                                            'richeditor' => RichEditor::make($fieldName)
                                                ->when(
                                                    $field['name'] === 'navbar_field',
                                                    fn (RichEditor $component) => $component->toolbarButtons(['orderedList'])
                                                ),
                                            'markdown' => MarkdownEditor::make($fieldName),
                                            'tags' => TagsInput::make($fieldName),
                                            'password' => TextInput::make($fieldName)->password(),
                                            default => TextInput::make($fieldName),
                                        };

                                        $component
                                            ->label(ucfirst(str_replace('_', ' ', $field['name'])).' ['.strtoupper($locale).']')
                                            ->default(
                                                is_array($stored)
                                                    ? ($stored[$locale] ?? ($stored[Localization::defaultLocale()] ?? ''))
                                                    : ($stored ?? $defaultValue)
                                            )
                                            ->dehydratedWhenHidden();

                                        if (isset($options['validation'])) {
                                            $component->rules($options['validation']);
                                        }

                                        $components[] = $component;
                                    }
                                }

                                return $components;
                            })
                            ->columns(2)
                            ->reorderable(false)
                            ->deletable(false)
                            ->reactive()
                            ->defaultItems(1)
                            ->addActionLabel(__('filawidget::filawidget.Display Fields'))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
