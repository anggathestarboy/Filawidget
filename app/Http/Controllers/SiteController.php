<?php

namespace App\Http\Controllers;

use App\Support\Localization;
use IbrahimBougaoua\Filawidget\Models\Field;
use IbrahimBougaoua\Filawidget\Services\AreaService;
use IbrahimBougaoua\Filawidget\Services\PageService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;

class SiteController extends Controller
{
    public function index(string $locale = 'id'): View
    {
        return $this->render($locale, 'homepage', [
            'header' => 'header',
            'hero' => 'hero',
            'cards' => 'cards',
            'footer' => 'footer',
        ], 'pages.homepage');
    }

    public function about(string $locale = 'id'): View
    {
        return $this->render($locale, 'about', [
            'header' => 'header',
            'hero' => 'about-hero',
            'cards' => 'about-cards',
            'footer' => 'footer',
        ]);
    }

    protected function render(string $locale, string $page, array $map, string $view = 'welcome'): View
    {
        App::setLocale($locale);

        $fieldNames = Field::pluck('name', 'id');

        $sections = collect($map)
            ->mapWithKeys(function ($areaIdentifier, $section) use ($fieldNames, $locale) {
                $area = AreaService::getWidgetByIdentifier($areaIdentifier);
                $area?->load(['widgets.values']);

                $widgets = collect($area?->widgets ?? [])->map(function ($widget) use ($fieldNames, $locale) {
                    $values = [];
                    foreach ($widget->values as $value) {
                        $values[$fieldNames[$value->widget_field_id] ?? $value->widget_field_id] =
                            Localization::localizedValue($value->value, $locale);
                    }

                    return [
                        'widget' => $widget,
                        'values' => $values,
                    ];
                })->values();

                return [$section => ['area' => $area, 'widgets' => $widgets]];
            });

        return view($view, [
            'locale' => $locale,
            'page' => $page,
            'sections' => $sections,
            'pages' => PageService::getAllPages(),
        ]);
    }
}
