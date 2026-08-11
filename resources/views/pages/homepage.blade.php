<x-app-layout
    :header-widget="$sections['header']['widgets']->first() ?? null"
    :footer-widget="$sections['footer']['widgets']->first() ?? null"
    :page="$page ?? 'homepage'"
    :locale="$locale ?? 'id'"
>
    {{-- ============ NEWS ============ --}}
    @isset($sections['news'])
        @if ($sections['news']['widgets']->count())
            <section class="py-5">
                <div class="container">
                    @php $newsArea = $sections['news']['area']; @endphp
                    <h2 class="section-title text-center mb-4">{{ $newsArea->description ?? $newsArea->name }}</h2>
                    <div class="row g-4">
                        @foreach ($sections['news']['widgets'] as $newsWidget)
                            @foreach ($newsWidget['values'] as $nw)
                                <div class="col-md-4">
                                    <a href="{{ ($locale === 'en' ? '/en' : '') . '/news/' . $newsWidget['widget']->id . '/' . $loop->index }}" class="text-decoration-none text-dark d-block h-100">
                                        <div class="card h-100 shadow-sm" style="border-top: 4px solid var(--dark-blue);">
                                            @if (!empty($nw['image']))
                                                <img src="{{ asset('storage/' . $nw['image']) }}" alt="{{ $nw['title'] ?? $newsWidget['widget']->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                            @endif
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between small text-muted mb-2">
                                                    @if (!empty($nw['published_at']))
                                                        <span>{{ \Carbon\Carbon::parse($nw['published_at'])->format('d M Y') }}</span>
                                                    @endif
                                                    @if (!empty($nw['author']))
                                                        <span>{{ $nw['author'] }}</span>
                                                    @endif
                                                </div>
                                                <h5 class="card-title fw-bold">{{ $nw['title'] ?? $newsWidget['widget']->name }}</h5>
                                                @if (!empty($nw['description']))
                                                    <div class="card-text text-secondary">{!! Str::limit(strip_tags($nw['description']), 120) !!}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endisset
</x-app-layout>
