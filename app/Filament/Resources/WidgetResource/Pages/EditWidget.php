<?php

namespace App\Filament\Resources\WidgetResource\Pages;

use App\Filament\Resources\WidgetResource;
use App\Filament\Resources\WidgetResource\Concerns\SavesWidgetValues;
use App\Models\WidgetField;
use App\Support\Localization;
use Filament\Actions;
use IbrahimBougaoua\Filawidget\Models\Field;
use IbrahimBougaoua\Filawidget\Models\WidgetType;
use IbrahimBougaoua\Filawidget\Resources\WidgetResource\Pages\EditWidget as BaseEditWidget;

class EditWidget extends BaseEditWidget
{
    use SavesWidgetValues;

    protected static string $resource = WidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $this->saveWidgetValues();
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $fieldsIds = $data['fieldsIds'] ?? null;

        if (empty($fieldsIds) && $this->record->widget_type_id) {
            $fieldsIds = WidgetType::find($this->record->widget_type_id)?->fieldsIds ?? [];
        }

        $fieldsIds = array_values(array_filter(array_map('intval', (array) $fieldsIds)));

        if (empty($fieldsIds)) {
            return $data;
        }

        $fields = Field::whereIn('id', $fieldsIds)->get(['id', 'name']);

        $stored = WidgetField::where('widget_id', $this->record->id)
            ->whereIn('widget_field_id', $fieldsIds)
            ->orderBy('position')
            ->get();

        $items = [];

        foreach ($stored->groupBy('position') as $group) {
            $item = [];

            foreach ($fields as $field) {
                $translations = $group->firstWhere('widget_field_id', $field->id)?->value ?? [];

                if (is_string($translations)) {
                    $translations = json_decode($translations, true) ?: [];
                }

                foreach (Localization::locales() as $locale => $label) {
                    $item["{$field->name}_{$locale}"] = $translations[$locale] ?? null;
                }
            }

            $items[] = $item;
        }

        $data['values'] = $items ?: [[]];

        return $data;
    }
}
