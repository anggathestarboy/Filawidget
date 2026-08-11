<?php

namespace App\Filament\Resources\WidgetResource\Concerns;

use App\Models\WidgetField;
use App\Support\Localization;
use IbrahimBougaoua\Filawidget\Models\Field;
use IbrahimBougaoua\Filawidget\Models\WidgetType;

trait SavesWidgetValues
{
    protected function saveWidgetValues(): void
    {
        $data = $this->form->getState();

        $widgetId = $this->record->id;

        WidgetField::where('widget_id', $widgetId)->delete();

        $fieldsIds = $this->record->fieldsIds ?? [];

        if (empty($fieldsIds) && $this->record->widget_type_id) {
            $fieldsIds = WidgetType::find($this->record->widget_type_id)?->fieldsIds ?? [];
        }

        $fieldsIds = array_values(array_filter(array_map('intval', (array) $fieldsIds)));

        if (empty($fieldsIds)) {
            return;
        }

        $fieldNames = Field::whereIn('id', $fieldsIds)->pluck('name', 'id');

        $position = 0;

        foreach ($data['values'] ?? [] as $item) {
            if (! is_array($item)) {
                continue;
            }

            foreach ($fieldsIds as $fieldId) {
                $name = $fieldNames[$fieldId] ?? null;

                if (blank($name)) {
                    continue;
                }

                $translations = [];

                foreach (Localization::locales() as $locale => $label) {
                    $value = $item["{$name}_{$locale}"] ?? null;

                    if ($value !== null && $value !== '') {
                        $translations[$locale] = $value;
                    }
                }

                WidgetField::create([
                    'widget_id' => $widgetId,
                    'widget_field_id' => $fieldId,
                    'position' => $position,
                    'value' => $translations,
                ]);
            }

            $position++;
        }
    }
}
