@props([
    'widget' => null,
    'locale' => 'id',
])

@if ($widget)
    @php
        $fv = $widget['values'][0] ?? [];
        $menuItems = \App\Support\Menu::fromHtml($fv['navbar_field'] ?? '');
    @endphp
    <footer class="bg-dark-blue text-white py-4 mt-4">
        <div class="container">
            <div class="row gy-3">
                {{-- Kiri: Title & Description --}}
                <div class="col-lg-4">
                    <h5 class="mb-2 fw-bold">{{ $fv['title'] ?? $widget['widget']->name }}</h5>
                    @if (!empty($fv['desc']))
                        <p class="mb-0 text-white-50 small">{{ $fv['desc'] }}</p>
                    @endif
                </div>

                {{-- Tengah: Menu Vertikal (Turun ke bawah) --}}
                <div class="col-lg-4">
                    @if ($menuItems)
                        <ul class="nav flex-column gap-1">
                            @foreach ($menuItems as $menuItem)
                                <li class="nav-item">
                                    <a class="nav-link p-0 text-white text-decoration-none" href="{{ $menuItem['url'] ?? '#' }}">
                                        {{ $menuItem['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Kanan: Social Media Icons Statis (Font Awesome) --}}
                <div class="col-lg-4 d-flex align-items-start justify-content-lg-end">
                    <div class="d-flex gap-3 fs-5">
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="text-white" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="text-white" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="text-white" aria-label="X (Twitter)">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="text-white" aria-label="LinkedIn">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="text-white" aria-label="YouTube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endif