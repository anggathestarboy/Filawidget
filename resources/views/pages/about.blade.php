<x-app-layout
    :header-widget="$sections['header']['widgets']->first() ?? null"
    :footer-widget="$sections['footer']['widgets']->first() ?? null"
    :page="$page ?? 'about'"
    :locale="$locale ?? 'id'"
>
    {{-- ============ ABOUT CARDS ============ --}}
    @isset($sections['cards'])
        @if ($sections['cards']['widgets']->count())
            <section class="py-5">
                <div class="container">
                    @php $cardsArea = $sections['cards']['area']; @endphp

                    @if (filled($cardsArea->description ?? null))
                        <h2 class="section-title text-center mb-4">{{ $cardsArea->description }}</h2>
                    @endif

                    <div class="row g-4">
                        @foreach ($sections['cards']['widgets'] as $cardWidget)
                            @foreach ($cardWidget['values'] as $card)
                                <div class="col-md-4">
                                    <div class="card h-100 shadow-sm" style="border-top: 4px solid var(--dark-blue);">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">{{ $card['title'] ?? $cardWidget['widget']->name }}</h5>
                                            @if (!empty($card['desc']))
                                                <div class="card-text text-secondary">{!! nl2br(e($card['desc'])) !!}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endisset
</x-app-layout>
