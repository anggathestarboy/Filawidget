<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Filament Widgets</title>
    <style>
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
                      @foreach ($pages as $key => $page)
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
                    <form class="d-flex">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                  </div>
                </div>
            </nav>
        </div>

        @foreach ($areas as $area)
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
                                <p class="card-text text-center fw-bold fs-2">˟</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        @endforeach
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>
</html