<?php

namespace App\Observers;

use IbrahimBougaoua\Filawidget\Models\Widget;
use Illuminate\Support\Str;

class WidgetObserver
{
    public function creating(Widget $widget): void
    {
        if (empty($widget->slug)) {
            $widget->slug = Str::slug($widget->name, '-');
        }
    }
}
