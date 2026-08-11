<x-app-layout
    :header-widget="$sections['header']['widgets']->first() ?? null"
    :footer-widget="$sections['footer']['widgets']->first() ?? null"
    :page="$page"
    :locale="$locale"
>
    <section class="py-5">
        <div class="container" style="max-width: 900px;">
            <nav class="mb-3" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ ($locale === 'en' ? '/en' : '') . '/homepage' }}">{{ $locale === 'en' ? 'Home' : 'Beranda' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                </ol>
            </nav>

            <article class="mt-4">
                <h1 class="section-title mb-4">{{ $page->title }}</h1>

                @if (!empty($page->content))
                    <div class="lh-lg fs-5">{!! $page->content !!}</div>
                @endif
            </article>
        </div>
    </section>
</x-app-layout>
