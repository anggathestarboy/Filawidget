<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Laravel Widgets</title>
    <style>
      :root {
        --dark-blue: #1e3a8a;
        --dark-blue-hover: #1e40af;
      }
      body {
        background-color: #ffffff;
        color: #111827;
      }
      .bg-dark-blue { background-color: var(--dark-blue); }
      .btn-dark-blue {
        background-color: var(--dark-blue);
        border-color: var(--dark-blue);
        color: #ffffff;
      }
      .btn-dark-blue:hover {
        background-color: var(--dark-blue-hover);
        border-color: var(--dark-blue-hover);
        color: #ffffff;
      }
      .btn-outline-dark-blue {
        color: var(--dark-blue);
        border-color: var(--dark-blue);
      }
      .btn-outline-dark-blue:hover {
        background-color: var(--dark-blue);
        border-color: var(--dark-blue);
        color: #ffffff;
      }
      .section-title {
        color: var(--dark-blue);
        font-weight: 700;
      }
      .widget-card {
        margin-bottom: 20px;
      }
      .widget-header {
        font-size: 1.25rem;
        font-weight: bold;
        background-color: #f8f9fa;
        padding: 10px;
        border-bottom: 1px solid #dee2e6;
      }
    </style>
  </head>
  <body>

    @if (isset($sections))
        {{-- ============ HEADER ============ --}}
        @php $headerWidget = $sections['header']['widgets']->first() ?? null; @endphp
        <x-site-header :widget="$headerWidget" :page="$page ?? 'homepage'" :locale="$locale ?? 'id'" />

        {{-- ============ HERO ============ --}}
        @foreach ($sections['hero']['widgets'] as $hero)
            @foreach ($hero['values'] as $hv)
                <section class="py-5">
                    <div class="container text-center">
                        @if (!empty($hv['image']))
                            <img src="{{ asset('storage/' . $hv['image']) }}" alt="{{ $hv['title'] ?? $hero['widget']->name }}" class="rounded img-fluid mb-4 shadow-lg" style="max-height: 320px; object-fit: cover;">
                        @endif
                        <h1 class="display-4 fw-bold">{{ $hv['title'] ?? $hero['widget']->name }}</h1>
                        @if (!empty($hv['desc']))
                            <p class="lead text-secondary mx-auto" style="max-width: 720px;">{{ $hv['desc'] }}</p>
                        @endif
                        @if (!empty($hv['button_label']))
                            <a href="{{ $hv['button_url'] ?? '#' }}" class="btn btn-dark-blue btn-lg px-4">{{ $hv['button_label'] }}</a>
                        @endif
                    </div>
                </section>
            @endforeach
        @endforeach

        {{-- ============ CARDS ============ --}}
        @if ($sections['cards']['widgets']->count())
            <section class="py-5 bg-light">
                <div class="container">
                    @php $cardsArea = $sections['cards']['area']; @endphp
                    <h2 class="section-title text-center mb-4">{{ $cardsArea->description ?? $cardsArea->name }}</h2>
                    <div class="row g-4">
                        @foreach ($sections['cards']['widgets'] as $card)
                            @foreach ($card['values'] as $cv)
                                <div class="col-md-4">
                                    <div class="card h-100 shadow-sm" style="border-top: 4px solid var(--dark-blue);">
                                        @if (!empty($cv['image']))
                                            <img src="{{ asset('storage/' . $cv['image']) }}" alt="{{ $cv['title'] ?? $card['widget']->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">{{ $cv['title'] ?? $card['widget']->name }}</h5>
                                            @if (!empty($cv['desc']))
                                                <p class="card-text text-secondary">{{ $cv['desc'] }}</p>
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

        {{-- ============ FOOTER ============ --}}
        @php $footerWidget = $sections['footer']['widgets']->first() ?? null; @endphp
        <x-site-footer :widget="$footerWidget" :locale="$locale ?? 'id'" />

    @else
        <div class="container mt-4">
            <div class="row px-2 py-2 mb-3 rounded border">
                <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Navbar</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @foreach ($pages ?? [] as $key => $page)
                                    @if(count($page->children))
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $key }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $page->title }}
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $key }}">
                                                @foreach ($page->children as $key => $sub_page)
                                                    <li>
                                                        <a class="dropdown-item" href="{{ $sub_page->slug }}">
                                                            {{ $sub_page->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $page->slug }}">
                                                {{ $page->title }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            @foreach ($areas ?? [] as $area)
                <div class="row px-2 py-2 mb-3 rounded border">
                    @forelse ($area->widgets as $widget)
                        <div class="col-md-4 px-2 py-2">
                            <div class="card widget-card mb-0">
                                <div class="widget-header">
                                    {{ $widget->name }}
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        {{ $widget->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 px-2 py-2">
                            <div class="card widget-card mb-0">
                                <div class="card-body bg-light">
                                    <p class="card-text text-center fw-bold">No Widget Found</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>
    @endif

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>
