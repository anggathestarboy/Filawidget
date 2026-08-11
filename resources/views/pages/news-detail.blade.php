<x-app-layout
    :header-widget="$header['widgets']->first() ?? null"
    :footer-widget="$footer['widgets']->first() ?? null"
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
                    <li class="breadcrumb-item active" aria-current="page">{{ $locale === 'en' ? 'News' : 'Berita' }}</li>
                </ol>
            </nav>

            <article class="mt-4">
                @if (!empty($news['image']))
                    <img src="{{ asset('storage/' . $news['image']) }}" alt="{{ $news['title'] ?? $newsWidget->name }}" class="img-fluid rounded shadow mb-4 w-100" style="max-height: 420px; object-fit: cover;">
                @endif

                <h1 class="fw-bold mb-3">{{ $news['title'] ?? $newsWidget->name }}</h1>

                <div class="d-flex gap-3 text-muted small mb-4">
                    @if (!empty($news['published_at']))
                        <span><i class="fa-regular fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($news['published_at'])->format('d M Y') }}</span>
                    @endif
                    @if (!empty($news['author']))
                        <span><i class="fa-regular fa-user me-1"></i>{{ $news['author'] }}</span>
                    @endif
                </div>

                @if (!empty($news['description']))
                    <div class="lh-lg fs-5">{!! $news['description'] !!}</div>
                @endif

                <div class="mt-5">
                    <a href="{{ ($locale === 'en' ? '/en' : '') . '/homepage' }}" class="btn btn-outline-dark-blue">
                        <i class="fa-solid fa-arrow-left me-1"></i>{{ $locale === 'en' ? 'Back to Home' : 'Kembali ke Beranda' }}
                    </a>
                </div>
            </article>
        </div>
    </section>
</x-app-layout>
