<?php

namespace App\Http\Controllers;

use App\Support\Localization;
use IbrahimBougaoua\Filawidget\Models\Field;
use IbrahimBougaoua\Filawidget\Models\Widget;
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
            'news' => 'news',
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

    public function newsDetail($widget, $position, string $locale = 'id'): View
    {
        $widget = (int) $widget;
        $position = (int) $position;

        App::setLocale($locale);

        $fieldNames = Field::pluck('name', 'id');

        $newsWidget = Widget::with('values')->findOrFail($widget);

        $news = $newsWidget->values
            ->where('position', $position)
            ->mapWithKeys(function ($value) use ($fieldNames, $locale) {
                return [
                    $fieldNames[$value->widget_field_id] ?? $value->widget_field_id =>
                        Localization::localizedValue($value->value, $locale),
                ];
            })
            ->all();

        abort_unless($news, 404);

        return view('pages.news-detail', [
            'locale' => $locale,
            'page' => "news/{$widget}/{$position}",
            'news' => $news,
            'newsWidget' => $newsWidget,
            'header' => $this->section('header', $fieldNames, $locale),
            'footer' => $this->section('footer', $fieldNames, $locale),
            'pages' => PageService::getAllPages(),
        ]);
    }

    protected function render(string $locale, string $page, array $map, string $view = 'welcome'): View
    {
        App::setLocale($locale);

        $fieldNames = Field::pluck('name', 'id');

        $sections = collect($map)
            ->mapWithKeys(function ($areaIdentifier, $section) use ($fieldNames, $locale) {
                return [$section => $this->section($areaIdentifier, $fieldNames, $locale)];
            });

        return view($view, [
            'locale' => $locale,
            'page' => $page,
            'sections' => $sections,
            'pages' => PageService::getAllPages(),
        ]);
    }

    protected function section(string $areaIdentifier, $fieldNames, string $locale): array
    {
        $area = AreaService::getWidgetByIdentifier($areaIdentifier);
        $area?->load(['widgets.values']);

        $widgets = collect($area?->widgets ?? [])->map(function ($widget) use ($fieldNames, $locale) {
            $sets = [];

            foreach ($widget->values->sortBy('position') as $value) {
                $position = (int) ($value->position ?? 0);

                $sets[$position][$fieldNames[$value->widget_field_id] ?? $value->widget_field_id] =
                    Localization::localizedValue($value->value, $locale);
            }

            return [
                'widget' => $widget,
                'values' => array_values($sets),
            ];
        })->values();

        return ['area' => $area, 'widgets' => $widgets];
    }
}
