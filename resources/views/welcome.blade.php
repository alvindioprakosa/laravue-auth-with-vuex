<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Vue Router App</title>

    <!-- Tailwind CSS CDN (untuk dev; untuk produksi disarankan build dengan PostCSS) -->
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <div id="app"></div>

    <!-- Laravel Mix asset -->
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
