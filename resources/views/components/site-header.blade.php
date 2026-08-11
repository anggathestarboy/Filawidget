@props([
    'widget' => null,
    'page' => 'homepage',
    'locale' => 'id',
])

@if ($widget)
    @php
        $hv = $widget['values'][0] ?? [];
        
    
        $enUrl = '/en/' . $page;
        $idUrl = '/' . $page;

        $homeUrl = $locale === 'en' ? '/en/homepage' : '/homepage';
        $menuItems = \App\Support\Menu::fromHtml($hv['navbar_field'] ?? '');
        $urlItems = \App\Support\Menu::fromHtml($hv['navbar_url'] ?? '');
        
        $currentPath = trim(request()->path(), '/');
        if (preg_match('#^(en|id)/(.+)$#', $currentPath, $currentMatch)) {
            $currentPath = $currentMatch[2];
        }
        $currentPath = $currentPath === '' ? 'homepage' : $currentPath;
    @endphp

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-blue shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ $homeUrl }}">{{ $hv['title'] ?? $widget['widget']->name }}</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNav">
                {{-- Menu Navigasi di sebelah kanan --}}
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-lg-3">
                    @foreach ($menuItems as $menuItem)
                        @php
                            $menuUrl = $urlItems[$loop->index]['url'] ?? null;
                            $href = $menuUrl ?? '#';
                            $targetPath = trim(parse_url((string) $href, PHP_URL_PATH) ?: '/', '/');
                            $targetPath = $targetPath === '' ? 'homepage' : $targetPath;
                            $isActive = $menuUrl !== null && $targetPath === $currentPath;
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ $isActive ? 'active' : '' }}" href="{{ $href }}">{{ $menuItem['label'] }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
                 
                    <div class="btn-group btn-group-sm" role="group" aria-label="Language Switcher">
                        <a href="{{ $idUrl }}" class="btn {{ $locale === 'id' ? 'btn-light fw-bold' : 'btn-outline-light' }}">ID</a>
                        <a href="{{ $enUrl }}" class="btn {{ $locale === 'en' ? 'btn-light fw-bold' : 'btn-outline-light' }}">EN</a>
                    </div>

                   
                    @if (!empty($hv['button_label']))
                        <a href="#" class="btn btn-danger btn-sm rounded fw-semibold px-3">{{ $hv['button_label'] }}</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
@endif