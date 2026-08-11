<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Laravel Widgets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
    <style>
      :root {
        --dark-blue: #1e3a8a;
        --dark-blue-hover: #1e40af;
      }
      body {
        background-color: #ffffff;
        color: #111827;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
      }
      main {
        flex: 1 0 auto;
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

    <x-site-header :widget="$headerWidget" :page="$page" :locale="$locale" />

    <main>
      {{ $slot }}
    </main>

    <x-site-footer :widget="$footerWidget" :locale="$locale" />

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>
