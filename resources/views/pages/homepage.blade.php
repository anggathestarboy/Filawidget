<x-app-layout
    :header-widget="$sections['header']['widgets']->first() ?? null"
    :footer-widget="$sections['footer']['widgets']->first() ?? null"
    :page="$page ?? 'homepage'"
    :locale="$locale ?? 'id'"
>
    {{-- Homepage content goes here --}}
</x-app-layout>
